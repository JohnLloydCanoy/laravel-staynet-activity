<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('loan_transactions', function (Blueprint $table) {
        $table->id();
        // Foreign Keys
        $table->unsignedBigInteger('loan_id');
        $table->unsignedBigInteger('customer_id');
        
        $table->decimal('amount_paid', 10, 2);
        $table->date('date_paid');
        $table->timestamps();

        // Relationship Definitions
        $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_transactions');
    }
};
