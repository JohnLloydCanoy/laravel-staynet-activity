<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Loan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">Description (e.g., Personal Loan):</label><br>
                        <input type="text" name="description" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">Amount (₱):</label><br>
                        <input type="number" step="0.01" name="amount" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">Term (Months):</label><br>
                        <input type="number" name="term" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold;">Interest Rate (%):</label><br>
                        <input type="number" step="0.01" name="interest" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: bold;">Date Granted:</label><br>
                        <input type="date" name="dategranted" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    <button type="submit" style="background-color: #3b82f6; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;">
                        Save Loan
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>