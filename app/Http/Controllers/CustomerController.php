<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $paginateInput = $request->input('paginate', 5);
        $search = $request->input('search');
        $sort = $request->input('sort', 'asc');
        $sortBy = $request->input('sort_by', 'name');
        $customers = Customer::all();

        // query
        $customers = Customer::when($search, function ($query, $search) {
            return $query->where('fullname', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('fullname', $sort)
            ->paginate($paginateInput)
            ->appends([
                'paginate' => $paginateInput,
                'search' => $search,
                'sort' => $sort,
                'sort_by' => $sortBy,
            ]);

        $noResults = $customers->isEmpty();
        return view('admin.customers.customers', compact('customers', 'noResults'));  // Refers to resources/views/customers.blade.php
    }
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        try {
            // Tạo mới khách hàng
            $customer = new Customer();
            $customer->fullname = $request->fullname;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            // Mã hóa mật khẩu
            $customer->password = Hash::make($request->password);

            $customer->save();

            return redirect()->back()->with('success', 'Customer added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to add customer: ' . $e->getMessage());
            return redirect()->back()->with('error', "Failed to add customer: {$e->getMessage()}. Please try again.");
        }
    }
    public function edit($customerID)
    {
        $customer = Customer::findOrFail($customerID);
        return response()->json($customer);
    }

    // Update customer details
    public function update(Request $request, $customerID)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customerID . ',customerID',  // Ensure email is unique except for the current customer
            'password' => 'nullable|string',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        $customer = Customer::findOrFail($customerID);

        // If password is provided, hash it, otherwise keep the existing password
        $customer->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $customer->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }


    // cútomer a customer
    public function toggleStatus($customerID)
    {
        $customer = Customer::find($customerID);

        if ($customer) {
            // Thay đổi trạng thái của sản phẩm
            $customer->status = !$customer->status;
            $customer->save();

            $status = $customer->status ? 'enabled' : 'disabled';
            return redirect()->back()->with('success', "customer has been {$status}");
        }

        return redirect()->back()->with('error', 'customer not found');
    }
}
