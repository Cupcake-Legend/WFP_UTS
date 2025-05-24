@extends('layouts.main')

@section('content')
    <div class="container">
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
    </section>
@endsection
