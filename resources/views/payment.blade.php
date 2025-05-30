@extends('layouts.main')

@section('content')
    <section class="products">
        <h3>Items Overview</h3>
        <div class="product">
            <div class="image"></div>
            <div>
                <p>Green Tea - $31</p>
                <small>1 Quantity</small>
            </div>
        </div>

        <h4>Available Shipping Method</h4>
        <p>📦 Post Office Delivery - Free</p>

        <h4>Payment Options</h4>
        <p>💳 Mobile Pay</p>
    </section>

    <section style="margin-top: 20px;">
        <h3>Payment Details</h3>
        <form>
            <input type="email" placeholder="Email Address" />
            <input type="text" placeholder="Full Name" />
            <input type="text" placeholder="Address" />
            <input type="text" placeholder="City" />
            <input type="text" placeholder="Zip Code" />
            <button type="submit">Finish Purchase</button>
        </form>
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
    </div>
@endsection
