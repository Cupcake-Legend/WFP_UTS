@extends('layouts.main')

@section('content')
    <div class="container">

        <!-- Struktur sama, hanya isi utama diubah -->
        <section class="products">
            <div class="product">
                <div class="image"></div>
                <div>
                    <h3>Green Tea</h3>
                    <p>200 kcal</p>
                    <ul>
                        <li>Carbohydrates: 10%</li>
                        <li>Protein: 10mg</li>
                    </ul>
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

    </div>
@endsection
