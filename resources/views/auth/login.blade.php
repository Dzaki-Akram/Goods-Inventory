@extends('layouts.app')

@section('content')
<div class="row min-vh-100">
    <!-- Bagian Kiri (Brand & Slogan) -->
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5">
        <h1 class="fw-bold text-primary" style="font-size: 3rem;">
            Goods Inventory
        </h1>
        <p class="lead" style="font-size: 1.2rem;">
            Manage and track your goods easily and efficiently.
        </p>
    </div>

    <!-- Bagian Kanan (Form Login) -->
    <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="w-75" style="max-width: 350px;">
            <div class="card shadow p-4">
                <h3 class="text-center mb-4">Login</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password + Toggle Eye -->
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            required>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer style="text-align: center; color: #0D47A1; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; padding: 10px;">
    © 2025 Goods Inventory
</footer>
@endsection

@push('scripts')
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Ganti ikon mata
        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
    });
</script>
@endpush