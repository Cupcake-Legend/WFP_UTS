@extends('layouts.main')

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
                        <button type="submit" @if($menu->stock == 0) disabled @endif>Add to Order</button>
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
@endsection