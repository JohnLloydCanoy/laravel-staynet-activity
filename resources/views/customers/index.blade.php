@extends('customers.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Customer Directory</h4>
        <div>
            <a href="{{ route('customers.pdf') }}" class="btn btn-success me-2">Download PDF</a>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
        </div>
    </div>
    <div class="card-body">

        <form action="{{ route('customers.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search ID, Name, or Address..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-dark">Search</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary ms-2">Reset</a>
        </form>

        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($customer->dob ?? $customer->date_of_birth)->format('M d, Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($customers->isEmpty())
        <div class="text-center mt-3 text-muted">No customers found. Please add one!</div>
        @endif

        <div class="mt-4">
            {{ $customers->links() }}
        </div>

    </div>
</div>
@endsection