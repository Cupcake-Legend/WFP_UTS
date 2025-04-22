@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Jumlah Menu Per Kategori</h3>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Kategori</th>
                    <th>Jumlah Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
