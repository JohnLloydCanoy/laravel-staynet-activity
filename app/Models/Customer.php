<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory; // THIS IS THE MAGIC LINE

    // Allowing mass assignment for your create/update forms
    protected $fillable = [
        'name',
        'address',
        'gender',
        'dob', // or 'date_of_birth' depending on your exact setup
    ];
}