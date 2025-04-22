@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Edit users</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password (biarkan kosong jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $user->alamat }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <input type="text" value="{{ $user->roles }}" class="form-control" readonly>
            </div>

            <input type="hidden" name="roles" value="{{ $user->roles }}">

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
@endsection
