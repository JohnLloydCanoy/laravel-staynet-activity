<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loan Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="font-size: 1.25rem; font-weight: bold;">Loan Directory</h3>
                        <a href="{{ route('loans.create') }}" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                            Add New Loan
                        </a>
                    </div>

                    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                        <thead style="background-color: #111827; color: white;">
                            <tr>
                                <th style="padding: 12px; text-align: left;">ID</th>
                                <th style="padding: 12px; text-align: left;">Description</th>
                                <th style="padding: 12px; text-align: left;">Amount</th>
                                <th style="padding: 12px; text-align: left;">Term (Mos)</th>
                                <th style="padding: 12px; text-align: left;">Interest</th>
                                <th style="padding: 12px; text-align: left;">Date Granted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loans ?? [] as $loan)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px;">{{ $loan->id }}</td>
                                    <td style="padding: 12px;">{{ $loan->description }}</td>
                                    <td style="padding: 12px;">₱{{ number_format($loan->amount, 2) }}</td>
                                    <td style="padding: 12px;">{{ $loan->term }}</td>
                                    <td style="padding: 12px;">{{ $loan->interest }}%</td>
                                    <td style="padding: 12px;">{{ $loan->dategranted }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 30px; color: #6b7280;">No loans found. Please add one!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>