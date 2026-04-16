<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    public function customer() {
    return $this->belongsTo(Customer::class);
}

public function loan() {
    return $this->belongsTo(Loan::class);
}
}
