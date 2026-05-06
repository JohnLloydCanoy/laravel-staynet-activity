<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * Accessible by: Admin, Staff, User
     */
    public function index(Request $request) 
    {
        $query = Customer::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->get('search');
            
            $query->where('name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
        }

        $customers = $query->latest()->paginate(10)->appends($request->all());

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * Accessible by: Admin ONLY
     */
    public function create()
    {
        // RBAC Check: Only Admins can view the create form
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only Admins can add customers.');
        }

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     * Accessible by: Admin ONLY
     */
    public function store(Request $request)
    {
        // RBAC Check: Only Admins can save new customers
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only Admins can add customers.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date'
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     * Accessible by: Admin, Staff, User
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * Accessible by: Admin and Staff
     */
    public function edit(Customer $customer)
    {
        // RBAC Check: Admins and Staff can edit
        if (!in_array(Auth::user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action. Only Admins and Staff can edit customers.');
        }

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     * Accessible by: Admin and Staff
     */
    public function update(Request $request, Customer $customer)
    {
        // RBAC Check: Admins and Staff can save edits
        if (!in_array(Auth::user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized action. Only Admins and Staff can edit customers.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date'
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
                        ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * Accessible by: Admin ONLY
     */
    public function destroy(Customer $customer)
    {
        // RBAC Check: Only Admins can delete
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only Admins can delete customers.');
        }

        $customer->delete();

        return redirect()->route('customers.index')
                        ->with('success', 'Customer deleted successfully.');
    }

    /**
     * Export PDF.
     * Accessible by: Admin ONLY
     */
    public function exportPDF()
    {
        // RBAC Check: Only Admins can download the PDF
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only Admins can download reports.');
        }

        $customers = Customer::latest()->get();
        $pdf = Pdf::loadView('customers.pdf', compact('customers'));
        return $pdf->download('customer_directory.pdf');
    }
}