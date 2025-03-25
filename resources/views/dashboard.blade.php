@extends('layouts.app')

@section('content')
    <!-- Navbar yang berada di paling atas dengan panjang lebih besar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">Management App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link active" href="/dashboard">Dashboard</a></li>
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

    <!-- Konten Dashboard, dengan margin-top untuk memberi ruang setelah navbar -->
    <div class="container mt-5 pt-5"> <!-- Pastikan margin-top cukup untuk konten -->
        <h1 class="text-center">Dashboard</h1>
        <div class="row mt-5">
            <!-- Fitur 1: Employees -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employees</h5>
                        <p class="card-text">Manage employees in the system.</p>
                        <a href="{{ route('employees.index') }}" class="btn btn-primary">Go to Employees</a>
                    </div>
                </div>
            </div>

            <!-- Fitur 2: Products -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Manage product details in the system.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
