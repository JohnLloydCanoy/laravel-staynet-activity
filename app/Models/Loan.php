<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function loanTransactions() {
    return $this->hasMany(LoanTransaction::class);
}
}
