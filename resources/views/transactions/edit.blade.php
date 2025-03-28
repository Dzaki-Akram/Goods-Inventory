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
                <li class="nav-item"><a class="nav-link active" href="/transactions">Transaction</a></li>

            </ul>
        </div>
    </div>
</nav>
<hr>
<br>
<div class="container mt-0 pt-2">
    <h2 class="mb-4">Edit Transaction</h2>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif


    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Transaction Date</label>
            <input
                type="date"
                name="transaction_date"
                id="transaction_date"
                class="form-control"
                value="{{ old('transaction_date', $transaction->transaction_date) }}"
                required>
            @error('transaction_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input
                type="number"
                step="0.01"
                name="total"
                id="total"
                class="form-control"
                value="{{ old('total', $transaction->total) }}"
                required>
            @error('total')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection