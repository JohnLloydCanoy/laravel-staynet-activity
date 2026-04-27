<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the loans.
     */
    public function index()
    {
        $loans = Loan::latest()->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        return view('loans.create');
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'term' => 'required|integer',
            'interest' => 'required|numeric',
            'dategranted' => 'required|date',
        ]);

        Loan::create($request->all());

        return redirect()->route('loans.index');
    }

    // You can leave the edit, update, show, and destroy methods blank 
    // for now unless you plan to add edit/delete buttons later!
    public function show(Loan $loan) {}
    public function edit(Loan $loan) {}
    public function update(Request $request, Loan $loan) {}
    public function destroy(Loan $loan) {}
}