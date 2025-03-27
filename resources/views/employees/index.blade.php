@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:rgb(37, 86, 139);">
    <div class="container">
        <a class="navbar-brand" href="/">Goods Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="/transactions">Transaction</a></li>
                <li class="nav-item"><a class="nav-link active" href="/employees">Employees</a></li>
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

<div class="container">
    <h2 class="mb-4">Employee List</h2>

    <!-- Wrapper untuk Add Employee & Search agar sejajar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('employees.create') }}" class="btn" style="background-color: rgb(235, 237, 70); color: #000;">
            <i class="bi bi-plus-circle me-1"></i> Add Employee
        </a>
        <div class="d-flex">
            <input type="text" id="searchInput" class="form-control w-auto" placeholder="Search Employee..." onkeyup="searchEmployee()">
            <button class="btn btn-success ms-2" onclick="searchEmployee()">Search</button>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered" id="employeesTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name_employee }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->position }}</td>
                <td>${{ number_format($employee->salary, 2) }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function searchEmployee() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("employeesTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { // Mulai dari 1 agar tidak mempengaruhi header tabel
            let employeeName = rows[i].getElementsByTagName("td")[0]; // Kolom pertama (Name)
            if (employeeName) {
                let nameValue = employeeName.textContent.toLowerCase();
                if (nameValue.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection