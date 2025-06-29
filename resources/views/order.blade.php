{{-- @extends('layouts.main')

@section('content')
    <!-- <h1>Order Your Food</h1> -->

    <div class="menu-list">
        @if ($menus->isEmpty())
            <p>No menu items available at the moment.</p>
        @else
            @foreach ($menus as $menu)
                <div class="menu-item">
                    <h2>{{ $menu->name }}</h2>
                    <p>{{ $menu->deskripsi }}</p>
                    <p>Price: Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <p>Stock: {{ $menu->stock }}</p>
                    @if ($menu->image)
                        <img src="{{ asset('storage/menu/' . $menu->image) }}" title="{{ $menu->name }}" width="350">
                    @endif
                    <p>Porsi: {{ $menu->porsi }}</p>
                    <p>Nutrisi: {{ $menu->nutrisi }}</p>
                    <p>Poin: {{ $menu->point }}</p>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <label for="quantity_{{ $menu->id }}">Quantity:</label>
                        <input type="number" id="quantity_{{ $menu->id }}" name="quantity" value="0" min="0" max="{{ $menu->stock }}">
                        <button type="submit" @if ($menu->stock == 0) disabled @endif>Add to Order</button>
                    </form>
                </div>
                <hr>
            @endforeach
        @endif
    </div>
    <!-- <div class="container">
        <header>
            <div>
                <button>Login</button>
                <button>Menu</button>
                <button>Reward</button>
            </div>
            <input type="text" placeholder="Search Menu..." />
        </header>

        <nav>Home > All products > Green Tea</nav>

        <section class="products">
            <div class="product">
                <div class="image"></div>
                <div>
                    <p>Green Tea</p>
                    <label>Quantity:</label>
                    <button>-</button><input type="text" value="1" /><button>+</button>
                    <button>Remove</button>
                </div>
            </div>

            <div>
                <label><input type="checkbox" /> Buying as a gift?</label>
                <label><input type="checkbox" /> Subscribe to newsletter</label>
            </div>

            <div style="margin-top: 10px;">
                <button>Go to checkout</button>
                <button>Back to store</button>
            </div>
    </div>
    </div>
    </section>

    <section>
        <h4>Shop similar</h4>
        <div class="products">
            <div class="product">
                <div class="image"></div>
                <p>$8</p><small>Jasmine Green Tea</small>
            </div>
            <div class="product">
                <div class="image"></div>
                <p>$10</p><small>Gunpowder Green Tea</small>
            </div>
            <div class="product">
                <div class="image"></div>
                <p>$22</p><small>Morning Bundle</small>
            </div>
            <div class="product">
                <div class="image"></div>
                <p>$6</p><small>Jasmine Green Tea</small>
            </div>
        </div>
    </section> -->

    </section>
@endsection --}}

@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h3 class="mb-3">Thank you! 🎉</h3>

        <div class="alert alert-success">
            Your order has been placed successfully.
        </div>

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
