@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgb(37, 86, 139);">
    <div class="container">
        <a class="navbar-brand" href="/">Goods Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Product</a></li>
                <li class="nav-item"><a class="nav-link active" href="/transactions">Transaction</a></li>
                <li class="nav-item"><a class="nav-link" href="/employees">Employees</a></li>
                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<hr>
<br>

<div class="container mt-0 pt-2">
    <h2 class="mb-4">Transaction List</h2>

    <a href="{{ route('transactions.create') }}"
        class="btn"
        style="background-color: rgb(235, 237, 70); color: #000; margin-bottom: 1rem;">
        <i class="bi bi-plus-circle me-1"></i>
        Add Transaction
    </a>

    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Tabel Daftar Transactions -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Total</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_date }}</td>
                <td>${{ number_format($transaction->total, 2) }}</td>
                <td>
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}"
                        method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection