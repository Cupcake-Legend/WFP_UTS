@if ($menus->count() > 0)
    <div class="scrollable-products products d-flex gap-3">
        @foreach ($menus as $menu)
            <div class="card h-100 shadow-sm" style="min-width:250px; max-width: 250px; flex: 0 0 auto;">
                <img src="{{ asset('images/menus/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}"
                    style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $menu->name }}</h5>
                    <p class="card-text text-success fw-bold mt-auto">
                        Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <button type="button" class="nav-btn btn btn-outline-primary mt-2" data-bs-toggle="modal"
                        data-bs-target="#menuModal" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}"
                        data-price="{{ $menu->harga }}" data-description="{{ $menu->deskripsi }}"
                        data-image="{{ $menu->image }}" data-nutrition="{{ $menu->nutrisi }}">
                        View Details
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">No products found.</div>
@endif
