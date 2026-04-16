<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .customer-shell .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .customer-shell .shadow-sm {
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.08);
        }

        .customer-shell .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .customer-shell .card-body {
            padding: 1.25rem;
            overflow-x: auto;
        }

        .customer-shell .d-flex {
            display: flex;
        }

        .customer-shell .justify-content-between {
            justify-content: space-between;
        }

        .customer-shell .align-items-center {
            align-items: center;
        }

        .customer-shell .d-inline {
            display: inline;
        }

        .customer-shell .mb-0 {
            margin-bottom: 0;
        }

        .customer-shell .mb-3 {
            margin-bottom: 1rem;
        }

        .customer-shell .mt-3 {
            margin-top: 1rem;
        }

        .customer-shell .text-center {
            text-align: center;
        }

        .customer-shell .text-muted {
            color: #6b7280;
        }

        .customer-shell .table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .customer-shell .table th,
        .customer-shell .table td {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .customer-shell .table-dark th {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        .customer-shell .table-hover tbody tr:hover {
            background: #f9fafb;
        }

        .customer-shell .btn {
            display: inline-block;
            padding: 0.5rem 0.85rem;
            border: 1px solid transparent;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            line-height: 1.2;
        }

        .customer-shell .btn-sm {
            padding: 0.38rem 0.7rem;
            font-size: 0.8rem;
        }

        .customer-shell .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }

        .customer-shell .btn-secondary {
            background: #6b7280;
            border-color: #6b7280;
            color: #ffffff;
        }

        .customer-shell .btn-success {
            background: #059669;
            border-color: #059669;
            color: #ffffff;
        }

        .customer-shell .btn-warning {
            background: #d97706;
            border-color: #d97706;
            color: #ffffff;
        }

        .customer-shell .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }

        .customer-shell .btn:hover {
            filter: brightness(0.95);
        }

        .customer-shell .form-label {
            display: block;
            margin-bottom: 0.4rem;
            color: #111827;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .customer-shell .form-control,
        .customer-shell .form-select {
            width: 100%;
            padding: 0.55rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background: #ffffff;
            color: #111827;
            font-size: 0.9rem;
        }

        .customer-shell .form-control:focus,
        .customer-shell .form-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .customer-shell .is-invalid {
            border-color: #dc2626;
        }

        .customer-shell .invalid-feedback {
            margin-top: 0.35rem;
            font-size: 0.82rem;
            color: #dc2626;
        }

        .customer-shell .alert {
            margin-bottom: 1rem;
            padding: 0.85rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .customer-shell .alert-dismissible {
            position: relative;
            padding-right: 2.5rem;
        }

        .customer-shell .btn-close {
            position: absolute;
            top: 0.65rem;
            right: 0.7rem;
            width: 1rem;
            height: 1rem;
            border: 0;
            background: transparent;
            color: #065f46;
            cursor: pointer;
            font-size: 1.1rem;
            line-height: 1;
        }

        .customer-shell .btn-close::before {
            content: "x";
        }

        .customer-shell .alert-success {
            background: #ecfdf3;
            border-color: #a7f3d0;
            color: #065f46;
        }
    </style>

    <div class="py-12 customer-shell">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" aria-label="Close" onclick="this.closest('.alert').remove()"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>
</x-app-layout>