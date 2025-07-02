@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h3 class="mb-3">Thank you! 🎉</h3>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Method:</strong> {{ $order->order_method }}</p>
                <p><strong>Payment:</strong> {{ $order->paymentMethod->name }}</p>
                <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <h5>Items:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Qty</th>
                    <th>Porsi</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->porsi }}</td>
                        <td>{{ $item->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('index') }}" class="btn btn-primary mt-3">Back to Home</a>
    </div>
@endsection
