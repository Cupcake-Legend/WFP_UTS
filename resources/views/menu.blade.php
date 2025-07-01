@extends('layouts.main')

@section('content')
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1511920170033-f8396924c348');
            background-size: cover;
            background-position: center;
            color: white;
        }
    </style>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container py-4">
        <!-- Hero Section -->
        <section class="hero-section text-center mb-5 p-5 bg-light rounded-3">
            <h1 class="display-4 fw-bold">Our Delicious Menu</h1>
            <p class="lead">Discover our carefully crafted selection of beverages and snacks</p>
        </section>

        <!-- Filter Section -->
        <section class="filter-section mb-5">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                    <h3 class="mb-0">Our Products</h3>
                </div>
                <div class="col-12 col-md-6 text-md-end">
                    <select id="categoryFilter" class="form-select w-100 w-md-50 d-inline-block">
                        <option value="All">All Categories</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Desserts">Desserts</option>
                        <option value="Sandwiches">Sandwiches</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Beverages">Beverages</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Product Grid -->
        <section class="products-wrapper mb-5">
            @if ($menus->count() > 0)
                <div class="scrollable-products products d-flex gap-3">
                    @foreach ($menus as $menu)
                        <div class="card h-100 shadow-sm" style="min-width: 250px; flex: 0 0 auto;">
                            <img src="{{ asset('images/menus/' . $menu->image) }}" class="card-img-top"
                                alt="{{ $menu->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $menu->name }}</h5>
                                <p class="card-text text-success fw-bold mt-auto">
                                    Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                                <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#menuModal" data-id="{{ $menu->id }}"
                                    data-name="{{ $menu->name }}" data-price="{{ $menu->harga }}"
                                    data-description="{{ $menu->deskripsi }}" data-image="{{ $menu->image }}"
                                    data-nutrition="{{ $menu->nutrisi }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">No products found.</div>
            @endif
        </section>


        {{-- <section class="products mb-5">
            @if ($menus->count() > 0)
                <div class="d-flex flex-row gap-3">
                    @foreach ($menus as $menu)
                        <div class="col">
                            <div class="card h-100 shadow-sm" style = "min-width: 250px;">
                                <img src="{{ $menu->image ? asset('storage/' . $menu->image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top" alt="{{ $menu->name }}"
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $menu->name }}</h5>
                                    <p class="card-text text-success fw-bold mt-auto">
                                        Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                        data-bs-target="#menuModal" data-id="{{ $menu->id }}"
                                        data-name="{{ $menu->name }}" data-price="{{ $menu->harga }}"
                                        data-description="{{ $menu->deskripsi }}"
                                        data-image="{{ $menu->image ? asset('$menu->image') : 'https://via.placeholder.com/300' }}"
                                        data-nutrition="{{ $menu->nutrisi }}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">No products found.</div>
            @endif
        </section> --}}

        <!-- Modal -->
        <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalLabel">Menu Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img id="modal-image" src="" alt="Menu Image" class="img-fluid rounded"
                                style="max-height: 200px;">
                        </div>
                        <h4 id="modal-name" class="mb-3"></h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="badge text-dark fs-6" id="modal-price"></span>
                            <span class="badge text-dark fs-6" id="modal-nutrition"></span>
                        </div>
                        <p class="text-muted" id="modal-description"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        @auth
                            <form action="{{ route('cart.add', ['menu' => '__menu_id__']) }}" method="POST"
                                id="add-to-cart-form" data-action="{{ route('cart.add', ['menu' => '__menu_id__']) }}">
                                @csrf
                                <input type="hidden" name="menu_id" id="hidden-menu-id">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="#" class="btn btn-primary">Login to Order</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Bestsellers Section -->
        <section class="bestsellers bg-light p-5 rounded-3">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Try our bestsellers</h2>
                    <p class="lead mb-0">At our shop, we believe in the power of herbs to heal and nourish the body. Our
                        bestsellers are crafted with care using the finest ingredients.</p>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Earl Gray</h5>
                                    <p class="card-text text-muted">Bold and Fruit Taste</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Jasmine Tea</h5>
                                    <p class="card-text text-muted">Light and Refreshing Taste</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                var imageUrl = "{{ asset('images/menus') }}/" + menuImage;

                var modal = $(this);
                modal.find('#modal-name').text(menuName);
                modal.find('#modal-price').text('Rp ' + menuPrice.toLocaleString('id-ID'));
                modal.find('#modal-description').text(menuDescription);
                modal.find('#modal-image').attr('src', imageUrl);
                modal.find('#modal-nutrition').text(menuNutrition);


                var form = modal.find('#add-to-cart-form');
                if (form.length) {
                    var actionTemplate = form.data('action');
                    form.attr('action', actionTemplate.replace('__menu_id__', menuId));
                    modal.find('#hidden-menu-id').val(menuId);
                }
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
                        alert('Failed to load menu data.');
                    }
                });
            });
        });
    </script>
@endsection
