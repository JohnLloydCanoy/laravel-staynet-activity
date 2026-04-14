<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request) 
    {
        // Start building the query
        $query = Customer::query();

        // If the user typed something in the search box, filter the results
        if ($request->has('search') && $request->search != '') {
            $search = $request->get('search');
            
            $query->where('name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
        }

        // Keep your 'latest()' ordering, but use paginate() instead of get()
        // appends() ensures the search word stays in the URL when clicking "Next Page"
        $customers = $query->latest()->paginate(10)->appends($request->all());

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
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
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
                        ->with('success', 'Customer deleted successfully.');
    }

    public function exportPDF()
    {
        // Get all customers (or you could filter them if you prefer)
        $customers = Customer::latest()->get();
        
        // Load a view and pass the customers to it
        $pdf = Pdf::loadView('customers.pdf', compact('customers'));
        
        // Download the file
        return $pdf->download('customer_directory.pdf');
    }
}