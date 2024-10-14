<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Display list of customers and handle customer creation
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.customers', compact('customers'));  // Refers to resources/views/customers.blade.php
    }

    // Store a new customer
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|',
            'phone' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        Customer::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer created successfully.');
    }

    // Show form for editing a customer in the same view
   // Show form for editing a customer
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
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }


    // Delete a customer
    public function destroy($customerID)
    {
        $customer = Customer::findOrFail($customerID);
        $customer->delete();

        return redirect()->route('customers.index')
                         ->with('success', 'Customer deleted successfully.');
    }
}
