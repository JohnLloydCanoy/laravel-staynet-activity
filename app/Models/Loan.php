<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    // Allow these fields to be saved
    protected $fillable = ['description', 'amount', 'term', 'interest', 'dategranted'];

    public function loanTransactions() 
    {
        return $this->hasMany(LoanTransaction::class);
    }
}