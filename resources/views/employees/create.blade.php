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
                <li class="nav-item"><a class="nav-link active" href="/employees">Employees</a></li>
            </ul>
        </div>
    </div>
</nav>
<hr>
<br>
<div class="container">
    <h2 class="mb-4">{{ isset($employee) ? 'Edit Employee' : 'Add Employee' }}</h2>

    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
        @csrf
        @if(isset($employee))
        @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name_employee" class="form-label">Name</label>
            <input type="text" class="form-control" id="name_employee" name="name_employee" value="{{ old('name_employee', $employee->name_employee ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $employee->age ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $employee->position ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" class="form-control" id="salary" name="salary" step="0.01" value="{{ old('salary', $employee->salary ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($employee) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection