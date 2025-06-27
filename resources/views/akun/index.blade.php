@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Profil Akun</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Dibuat:</strong> {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
