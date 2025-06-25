@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4">Profil Akun</h4>
    
    @if($user)
    <div class="card p-4 shadow-sm">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <!-- Tambahkan data lain jika perlu -->
        <a href="/dashboard" class="btn btn-success mt-3">Kembali ke Dashboard</a>
    </div>
    @else
    <div class="alert alert-warning">Tidak ada data pengguna.</div>
    @endif
</div>
@endsection
<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>
