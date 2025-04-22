@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Kategori dengan Paling Banyak Menu</h3>

        @if($most)
            <p><strong>Kategori:</strong> {{ $most->name }}</p>
            <p><strong>Jumlah Menu:</strong> {{ $most->menus_count }}</p>
        @else
            <p>No data available</p>
        @endif
    </div>
@endsection
