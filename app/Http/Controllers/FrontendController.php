<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\Models\Blueprint;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('home', [
            'products' => $products
        ]);
    }

    public function addCart(Request $request)
    {
        $product_id = $request->productID;
        $product_qty = $request->product_qty;
        if (is_null(Session::get('cart.cart'))) {
            Session::put('cart.cart', [$product_id => $product_qty]);
            return redirect('/cart');
        } else {
            $cart = Session::get('cart.cart');
            if (Arr::exists($cart, $product_id)) {
                $cart[$product_id] += $product_qty;
                Session::put('cart.cart', $cart);
                return redirect('/cart');
            } else {
                $cart[$product_id] = $product_qty;
                Session::put('cart.cart', $cart);
                return redirect('/cart');
            }
        }
    }
    public function showCart()
    {
        $cart = Session::get('cart.cart', []); // Retrieve cart or an empty array if not set
        $product_ids = array_keys($cart); // Get product IDs from the cart
        $products = Product::whereIn('productID', $product_ids)->get(); // Retrieve product data

        // Initialize total quantity and total price
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($products as $product) {
            // Set quantity for each product (from cart)
            $product->quantity = $cart[$product->productID]; // Quantity of this product from the cart
            $product->total_price = $product->price * $product->quantity; // Calculate total price for this product
            $totalQuantity += $product->quantity; // Sum up the total quantity
            $totalPrice += $product->total_price; // Add product total price to overall total price
        }

        // Calculate remaining amount for free shipping
        $freeShipThreshold = 2000000; // The threshold for free shipping (2.000.000 VND)
        $remainingForFreeShip = max(0, $freeShipThreshold - $totalPrice); // Calculate the missing amount for free shipping

        // Determine if the user has reached the threshold for free shipping
        $freeShipMessage = $remainingForFreeShip > 0
            ? 'Buy ' . number_format($remainingForFreeShip) . ' VND more to have freeship'
            : 'You are having freeship';

        return view('cart.cart', [
            'products' => $products,
            'totalQuantity' => $totalQuantity, // Send the total quantity to the view
            'totalPrice' => $totalPrice, // Send the total price to the view
            'freeShipMessage' => $freeShipMessage, // Send the free shipping message
        ]);
    }

    public function deleteCart(Request $request)
    {
        $cart = Session::get('cart.cart');
        $product_id = $request->productID;
        unset($cart[$product_id]);
        Session::put('cart.cart', $cart);
        return redirect('/cart');
    }

    public function updateQuantity(Request $request, $id)
    {
        // Nhận giá trị số lượng từ yêu cầu
        $quantity = $request->input('quantity');

        // Kiểm tra xem số lượng có hợp lệ không
        if ($quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Quantity must be at least 1']);
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart.cart', []);

        // Kiểm tra xem sản phẩm có trong giỏ hàng không
        if (isset($cart[$id])) {
            // Cập nhật số lượng sản phẩm
            $cart[$id] = $quantity;

            // Cập nhật giỏ hàng trong session
            session()->put('cart.cart', $cart);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found in cart']);
        }

        // Tính toán tổng số lượng và tổng giá trị
        $totalQuantity = array_sum($cart);
        $totalPrice = $this->calculateTotalPrice($cart);

        return response()->json(['success' => true, 'totalQuantity' => $totalQuantity, 'totalPrice' => $totalPrice]);
    }

    // Hàm tính toán tổng giá trị giỏ hàng
    private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;
        foreach ($cart as $productID => $quantity) {
            $product = Product::find($productID); // Lấy thông tin sản phẩm
            if ($product) {
                $totalPrice += $product->price * $quantity; // Cộng dồn tổng giá trị
            }
        }
        return $totalPrice;
    }

    public function interiorDesign()
    {
        $blueprints = Blueprint::with('categoryDesign')->get();
        return view('interior-design', compact('blueprints'));
    }

    public function showProduct($productID)
    {
        $product = Product::with('category')->findOrFail($productID);
        $brand = Product::with('category')->findOrFail($productID);
        return view('view', [
            'product' => $product,
        ]);
    }
    public function showProductDetail(Request $request)
    {
        $product = Product::find($request->productID);
        $products = Product::take(5)->get();
        return view('product.product_detail', [
            'product' => $product,
            'products' => $products,

        ]);
    }
    public function showCategory(Request $request, $categoryID)
    {
        $category = Category::findOrFail($categoryID);

        $paginateInput = $request->input('paginate', 8);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'price');

        $products = Product::with('category', 'brand')
            ->when($search, function ($query, $search) {
                return $query->where('products.name', 'LIKE', '%' . $search . '%');
            })
            ->join('brands', 'products.brandID', '=', 'brands.brandID')
            ->where('products.categoryID', $categoryID)
            ->select('products.*', 'brands.name as brand_name')
            ->orderBy(
                match ($sortBy) {
                    'brand' => 'brand_name',
                    'price' => 'products.price',
                    'quantityInStock' => 'products.quantityInStock',
                    'inStocked' => 'products.inStocked',
                    default => 'products.name',
                },
                $sort
            )
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $products->isEmpty();

        return view('product.category', [
            'category' => $category,
            'products' => $products,
            'noResults' => $noResults,
        ]);
    }
    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $categoryID = $request->input('categoryID');

        $products = Product::where('categoryID', $categoryID)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json(['products' => $products]);
    }
    public function showDeliveryPage()
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart.cart', []);

        // Kiểm tra xem giỏ hàng có rỗng không
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. No items to purchase.');
        }

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $products = Product::whereIn('productID', array_keys($cart))->get();

        // Khởi tạo tổng giá trị
        $total = 0;

        // Tính tổng giá trị dựa trên số lượng sản phẩm
        foreach ($products as $product) {
            $quantity = $cart[$product->productID]; // Lấy số lượng từ giỏ hàng
            $total += $product->price * $quantity; // Tính tổng giá trị
        }

        // Tính VAT (giả sử 10%)
        $vat = $total * 0.1; // Điều chỉnh tỷ lệ VAT nếu cần
        $totalAmount = $total + $vat; // Tính tổng số tiền bao gồm VAT

        // Trả về view với các thông tin cần thiết
        return view('order.delivery', compact('products', 'cart', 'total', 'vat', 'totalAmount'));
    }
    public function submitOrder(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:cash,credit_card',
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart.cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $totalPrice = 0;
        $orderDetails = [];

        // Tính toán tổng giá trị và chi tiết đơn hàng
        foreach ($cart as $productID => $quantity) {
            $product = Product::find($productID);
            if ($product) {
                $totalPrice += $product->price * $quantity;
                $orderDetails[] = [
                    'productID' => $productID,
                    'quantity' => $quantity,
                    'status' => 1, // Giả sử 1 là trạng thái 'Pending'
                ];
            }
        }

        // Tính VAT và tổng số tiền
        $vat = $totalPrice * 0.1; // 10% VAT
        $totalAmount = $totalPrice + $vat;

        // Tạo một đơn hàng mới
        $order = new Order();
        $order->customerID = Auth::check() ? Auth::id() : null;
        $order->orderDate = now()->toDateTimeString();
        $order->status1 = 'Pending';
        $order->totalPrice = $totalPrice;
        $order->shippingAddress = $validatedData['address'];
        $order->save();

        // Tạo chi tiết đơn hàng
        foreach ($orderDetails as $detail) {
            // Thêm orderID vào chi tiết đơn hàng
            $detail['orderID'] = $order->orderID; // Đảm bảo orderID được thêm vào
            // Tạo chi tiết đơn hàng với productID
            OrderDetail::create($detail);
        }

        // Gửi email xác nhận
        Mail::to($validatedData['email'])->send(new OrderConfirmationMail($order, $cart, $totalPrice, $vat, $totalAmount, $orderDetails));

        // Xóa giỏ hàng
        session()->forget('cart');

        // Chuyển hướng đến trang xác nhận đơn hàng
        return redirect()->route('order.confirm', ['id' => $order->orderID]);
    }

    public function orderConfirmation($orderID)
    {
        // Retrieve the order from the database
        $order = Order::findOrFail($orderID);

        // Retrieve order details
        $orderDetails = OrderDetail::where('orderID', $orderID)->get();

        // Calculate VAT (assuming 10%)
        $vat = $order->totalPrice * 0.1; // Adjust the VAT rate as needed
        $totalAmount = $order->totalPrice + $vat; // This is already calculated in submitOrder

        // Pass order, total amount, and order details data to the view
        return view('order-confirm', compact('order', 'totalAmount', 'orderDetails'));
    }

    public function show($orderId)
    {
        $order = Order::with('products')->find($orderId); // Load the order with its products

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        return view('view', ['order' => $order]);
    }

    // //order history
    // public function showOrderHistory()
    // {
    //     // Fetch orders for the authenticated user
    //     $orders = Order::where('customerID', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

    //     // Return the view with the orders data
    //     return view('order-history', compact('orders'));
    // }

    public function showOrderDetails($orderID)
    {
        // Retrieve the order details by order ID
        $orderDetails = OrderDetail::with('product') // Eager load the product relationship
            ->where('orderID', $orderID) // Filter by orderID
            ->get();

        // Check if any order details were found
        if ($orderDetails->isEmpty()) {
            return view('order-details', ['orderDetails' => $orderDetails, 'message' => 'No details found for this order.']);
        }

        // Return the view with the order details
        return view('order-details', compact('orderDetails'));
    }
}
