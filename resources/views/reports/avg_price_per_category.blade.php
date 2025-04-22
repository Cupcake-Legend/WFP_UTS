@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3>Rata-rata Harga Menu per Kategori</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Rata-rata Harga (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ number_format($item->avg_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
