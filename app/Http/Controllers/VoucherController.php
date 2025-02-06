<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vouchers = Voucher::all();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('voucher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers|max:255',
            'discount' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        try {
            Voucher::create($request->all());
            return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully.');
        } catch (Exception $e) {
            return redirect()->route('vouchers.create')->with('error', 'Voucher code already exists. Please choose another one.');
        }
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|max:255|unique:vouchers,code,' . $voucher->id,
            'discount' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        try {
            $voucher->update($request->all());
            return redirect()->route('vouchers.index')->with('success', 'Voucher updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('vouchers.edit', $voucher->id)->with('error', 'Failed to update voucher. Please try again.');
        }
    }


    public function show(string $id) {}

    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('vouchers.index')->with('success', 'Voucher deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->status = !$voucher->status;
        $voucher->save();

        return redirect()->route('vouchers.index')->with('success', 'Voucher status updated successfully.');
    }
    public function checkCode(Request $request)
    {
        $exists = Voucher::where('code', $request->code)->exists();
        return response()->json(['exists' => $exists]);
    }
}
