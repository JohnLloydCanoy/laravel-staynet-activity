<div style="padding: 20px; max-width: 500px; margin: auto;">
    <h2>Add New Loan Transaction</h2>
    
    <form action="{{ route('loantransactions.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label>Select Customer:</label><br>
            <select name="customer_id" style="width: 100%; padding: 8px;">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Select Loan:</label><br>
            <select name="loan_id" style="width: 100%; padding: 8px;">
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}">{{ $loan->description }} - ₱{{ $loan->amount }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Amount Paid:</label><br>
            <input type="number" step="0.01" name="amount_paid" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Date Paid:</label><br>
            <input type="date" name="date_paid" style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" style="padding: 10px 15px; background: #3b82f6; color: white; border: none; border-radius: 4px;">Save Transaction</button>
    </form>
</div>