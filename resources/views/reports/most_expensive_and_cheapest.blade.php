@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Menu Termahal dan Termurah</h3>

        <div>
            <h5><strong>Menu Termahal:</strong> {{ $max->name }} (Rp
                {{ number_format($max->harga, 0, ',', '.') }})</h5>
        </div>

        <div>
            <h5><strong>Menu Termurah:</strong> {{ $min->name }} (Rp
                {{ number_format($min->harga, 0, ',', '.') }})</h5>
        </div>
    </div>
@endsection
