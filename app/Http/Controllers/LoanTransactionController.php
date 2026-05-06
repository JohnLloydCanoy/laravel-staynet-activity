<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Loan;
use App\Models\LoanTransaction;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $transactions = LoanTransaction::with(['customer', 'loan'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })->get();

        return view('loantransactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $loans = Loan::all();
        return view('loantransactions.create', compact('customers', 'loans'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $request->validate([
            'customer_id' => 'required',
            'loan_id' => 'required',
            'amount_paid' => 'required|numeric',
            'date_paid' => 'required|date',
        ]);

        // 2. Save the transaction to the database
        \App\Models\LoanTransaction::create($request->all());

        // 3. Redirect back to the transaction directory
        return redirect()->route('loantransactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generatePDF()
{
    $transactions = LoanTransaction::with(['customer', 'loan'])->get();
    $pdf = Pdf::loadView('loantransactions.pdf', compact('transactions'));
    
    return $pdf->download('transactions_report.pdf');
}

}
