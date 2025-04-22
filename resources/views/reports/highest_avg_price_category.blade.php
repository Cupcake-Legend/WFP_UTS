@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Kategori dengan Harga Rata-rata Tertinggi</h3>

        @if($data)
            <p><strong>Kategori:</strong> {{ $data->name }}</p>
            <p><strong>Harga Rata-rata (Rp):</strong> {{ number_format($data->average_price, 0, ',', '.') }}</p>
        @else
            <p>No data available</p>
        @endif
    </div>
@endsection
