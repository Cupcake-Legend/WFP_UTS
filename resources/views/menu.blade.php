@extends('layouts.main')

@section('content')
    <div class="container">

        <!-- FILTER BUTTONS -->
        <section class="filter-section">
            <button class="filter-button">Tea Type</button>
            <button class="filter-button">Size</button>
            <button class="filter-button">Strength</button>
            <button class="filter-button">Caffeine</button>
            <button class="filter-button">Source</button>
            <select id="categoryFilter" class = "form-control">
                <option value="All">All Categories</option>
                <option value="Tea">Tea</option>
                <option value="Coffee">Coffee</option>
                <option value="Snacks">Snacks</option>
                <option value="Desserts">Desserts</option>
            </select>
            <input class="form-control" type="text" placeholder="Search Menu...">


        </section>


        <!-- PRODUCT GRID -->
        <section class="products">

            @foreach ($menus as $menu)
                <div class="product">
                    <div class="image"><img src="" alt="{{ $menu->image }}"></div>
                    <h5>{{ $menu->name }}</h5>
                    <p>Rp{{ $menu->harga }}</p>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuModal"
                        data-id="{{ $menu->id }}" data-name="{{ $menu->name }}" data-price="{{ $menu->harga }}"
                        data-description="{{ $menu->deskripsi }}" data-image="{{ $menu->image }}"
                        data-nutrition = "{{ $menu->nutrisi }}">
                        Details
                    </button>

                </div>
            @endforeach
        </section>

        {{-- MODAL --}}

        <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="menuModalLabel">Menu Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="modal-image" src="" alt="Menu Image" class="img-fluid mb-3">
                        <h5 id="modal-name"></h5>
                        <p id="modal-price"></p>
                        <p id="modal-description"></p>
                        <p id ="modal-nutrition"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- BESTSELLERS -->
        <section class="bestsellers">
            <h3>Try our bestsellers</h3>
            <p>At our shop, we believe in the power of herbs to heal and nourish the body...</p>
            <div class="bestseller-list">
                <div class="bestseller-item">
                    <h5>Earl Gray</h5>
                    <small>Bold and Fruit Taste</small>
                </div>
                <div class="bestseller-item">
                    <h5>Jasmine Tea</h5>
                    <small>Light and Refreshing Taste</small>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#menuModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var menuId = button.data('id');
                var menuName = button.data('name');
                var menuPrice = button.data('price');
                var menuDescription = button.data('description');
                var menuImage = button.data('image');
                var menuNutrition = button.data('nutrition');

                var modal = $(this);
                modal.find('#modal-name').text(menuName);
                modal.find('#modal-price').text('Rp ' + menuPrice);
                modal.find('#modal-description').text(menuDescription);
                modal.find('#modal-image').attr('src', menuImage);
                modal.find('#modal-nutrition').text(menuNutrition);
            });

            $('#categoryFilter').on('change', function() {
                var selectedCategory = $(this).val();

                $.ajax({
                    url: '/filter-category',
                    method: 'GET',
                    data: {
                        category: selectedCategory
                    },
                    success: function(response) {
                        $('.products').html(response.html);
                    },
                    error: function() {
                        alert('Gagal memuat data menu.');
                    }
                });
            });
        });
    </script>
@endsection
