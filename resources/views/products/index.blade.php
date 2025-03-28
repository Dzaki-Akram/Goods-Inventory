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
                <li class="nav-item"><a class="nav-link active" href="/products">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="/transactions">Transaction</a></li>
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
    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title text-center">Products</h5>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <div class="card text-center" style="background-color: #f8f9fa;">
                                <div class="card-body">
                                    <h2>{{ number_format($allProductsCount) }}</h2>
                                    <p>All Products</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="card text-center" style="background-color: #f8f9fa;">
                                <div class="card-body">
                                    <h2>{{ number_format($availableProductsCount) }}</h2>
                                    <p>Available Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Product Type</h5>
                    <div class="d-flex justify-content-center">
                        <canvas id="productPieChart" width="150" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Product List</h2>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('products.create') }}" class="btn" style="background-color: rgb(235, 237, 70); color: #000;">
            <i class="bi bi-plus-circle me-1"></i> Add Product
        </a>
        <div class="d-flex">
            <input type="text" id="searchInput" class="form-control w-auto me-2" placeholder="Search product..." onkeyup="searchProduct()">
            <button class="btn btn-success" onclick="searchProduct()">Search</button>
        </div>
    </div>

    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody id="productTable">
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name_product }}</td>
                <td>{{ $product->quantity }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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

<script>
    function searchProduct() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("productTable");
        let rows = table.getElementsByTagName("tr");
        for (let row of rows) {
            let productName = row.cells[0].textContent.toLowerCase();
            row.style.display = productName.includes(input) ? "" : "none";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxPie = document.getElementById('productPieChart').getContext('2d');
    const productPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['A', 'B', 'C'],
            datasets: [{
                data: [12, 19, 7],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 20,
                        padding: 10
                    }
                }
            }
        }
    });
</script>
@endsection