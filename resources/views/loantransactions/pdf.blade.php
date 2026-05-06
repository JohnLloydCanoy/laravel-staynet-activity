<!DOCTYPE html>
<html>
<head>
    <title>Loan Transactions Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #dddddd; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Loan Transactions Report</h2>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Loan Description</th>
                <th>Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ $t->customer->name ?? 'N/A' }}</td>
                <td>{{ $t->loan->description ?? 'N/A' }}</td>
                <td>P{{ number_format($t->amount_paid, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>