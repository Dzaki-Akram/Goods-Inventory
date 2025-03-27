@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgb(37, 86, 139);">
    <div class="container">
        <a class="navbar-brand" href="/">Goods Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Product</a></li>
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

<!-- Konten Dashboard, dengan margin-top & padding-top untuk memberi ruang setelah navbar -->
<div class="container mt-5 pt-5">
    <!-- Banner Welcome -->
    <div class="card p-4 mb-4 shadow" style="border-radius: 1rem; background-color: #f8f9fa;">
        <div class="row align-items-center">
            <!-- Gambar / Ikon di Kiri -->
            <div class="col-md-3 text-center">
                <i class="bi bi-box-seam" style="font-size: 5rem; color: rgb(37, 86, 139);"></i>
            </div>
            <!-- Teks Welcome di Kanan -->
            <div class="col-md-9">
                <h2 class="fw-bold mb-2" style="color: rgb(37, 86, 139);">
                    Welcome to Goods Inventory
                </h2>
                <p class="mb-0">
                    Inventaris barang yang baik adalah inventaris yang terkelola dengan baik
                </p>
            </div>
        </div>
    </div>

    <!-- Bagian Card Fitur -->
    <div class="row">
        <!-- Fitur 1: Employees -->
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: rgb(37, 86, 139); color: #f4f4f4;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-people-fill me-2"></i>
                        Employees
                    </h5>
                    <p class="card-text">Manage employees in the system.</p>
                    <a href="{{ route('employees.index') }}" class="btn"
                        style="background-color: rgb(235, 237, 70); color: #000;">
                        <i class="bi bi-people me-1"></i>
                        Manage Employees
                    </a>
                </div>
            </div>
        </div>

        <!-- Fitur 2: Products -->
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: rgb(37, 86, 139); color: #f4f4f4;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-box-seam me-2"></i>
                        Products
                    </h5>
                    <p class="card-text">Manage product details in the system.</p>
                    <a href="{{ route('products.index') }}" class="btn"
                        style="background-color: rgb(235, 237, 70); color: #000;">
                        <i class="bi bi-box2 me-1"></i>
                        Manage Product
                    </a>
                </div>
            </div>
        </div>

        <!-- Fitur 3: Transaction -->
        <div class="col-md-4 mb-3">
            <div class="card" style="background-color: rgb(37, 86, 139); color: #f4f4f4;">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-cash-coin me-2"></i>
                        Transaction
                    </h5>
                    <p class="card-text">Manage transactions in the system.</p>
                    <a href="{{ route('transactions.index') }}" class="btn"
                        style="background-color: rgb(235, 237, 70); color: #000;">
                        <i class="bi bi-wallet2 me-1"></i>
                        Manage Transaction
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Statistik dan Tabel Produk Baru -->
    <div class="row mt-4">
        <!-- Chart Purchase & Sales (Stacked Bar) -->
        <div class="col-md-8 mb-3">
            <div class="card shadow">
                <!-- Header card dengan warna biru (navbar) -->
                <div class="card-header d-flex justify-content-between align-items-center"
                    style="background-color: rgb(37, 86, 139); color: #fff;">
                    <h5 class="mb-0">Purchase & Sales</h5>
                    <!-- Dropdown tahun (opsional) -->
                    <div>
                        <select class="form-select form-select-sm">
                            <option value="2022" selected>2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Canvas untuk Chart -->
                    <canvas id="myChart" height="110"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabel Produk Terbaru (Kolom: No, Nama Produk, Harga) -->
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <div class="card-header" style="background-color: rgb(37, 86, 139); color: #fff;">
                    <h5 class="mb-0">Recently Products</h5>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name_product }}</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                            @endforeach
                            @if($recentProducts->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">No recent products found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Stacked bar chart untuk Purchase & Sales
    const ctx = document.getElementById('myChart').getContext('2d');

    // Contoh data; sesuaikan dengan kebutuhan Anda
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'];
    const salesData = [40, 60, 50, 70, 65, 80, 55, 75]; // Sales: nilai positif (hijau)
    const purchaseData = [-30, -45, -35, -50, -40, -60, -45, -55]; // Purchase: nilai negatif (merah)

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Purchase',
                    data: purchaseData,
                    backgroundColor: 'rgba(244, 67, 54, 0.7)', // merah
                    borderColor: 'rgba(244, 67, 54, 1)',
                    borderWidth: 1,
                    borderRadius: 3,
                    barThickness: 20,
                    stack: 'combined'
                },
                {
                    label: 'Sales',
                    data: salesData,
                    backgroundColor: 'rgba(76, 175, 80, 0.7)', // hijau
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 1,
                    borderRadius: 3,
                    barThickness: 20,
                    stack: 'combined'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            }
        }
    });
</script>

<footer style="text-align: center; color: #0D47A1; width: 100%; padding: 10px; margin-top: 20px;">
    © 2025 Goods Inventory
</footer>

@endsection