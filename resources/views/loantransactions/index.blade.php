<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loan Transactions Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-size: 1.25rem; font-weight: bold;">Transaction Directory</h3>
                        <div>
                            <a href="{{ route('loantransactions.pdf') }}" style="background-color: #10b981; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-right: 10px; font-weight: bold;">
                                Download PDF
                            </a>
                            <a href="{{ route('loantransactions.create') }}" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                                Add Transaction
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('loantransactions.index') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
                        <input type="text" name="search" placeholder="Search Customer Name..." value="{{ request('search') }}" style="padding: 8px; width: 100%; max-width: 400px; border-radius: 6px; border: 1px solid #d1d5db;">
                        <button type="submit" style="background-color: #1f2937; color: white; padding: 8px 16px; border-radius: 6px;">Search</button>
                        <a href="{{ route('loantransactions.index') }}" style="background-color: #9ca3af; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none;">Reset</a>
                    </form>

                    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                        <thead style="background-color: #111827; color: white;">
                            <tr>
                                <th style="padding: 12px; text-align: left;">Customer</th>
                                <th style="padding: 12px; text-align: left;">Loan Details</th>
                                <th style="padding: 12px; text-align: left;">Amount Paid</th>
                                <th style="padding: 12px; text-align: left;">Date Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions ?? [] as $t)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px;">{{ $t->customer->name ?? 'N/A' }}</td>
                                    <td style="padding: 12px;">{{ $t->loan->description ?? 'N/A' }}</td>
                                    <td style="padding: 12px;">₱{{ number_format($t->amount_paid, 2) }}</td>
                                    <td style="padding: 12px;">{{ $t->date_paid }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 30px; color: #6b7280;">No transactions found. Please add one!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>