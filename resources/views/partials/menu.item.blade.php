@foreach ($menus as $menu)
    <div class="product">
        <div class="image"><img src="" alt="{{ $menu->image }}"></div>
        <h5>{{ $menu->name }}</h5>
        <p>Rp{{ $menu->harga }}</p>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuModal"
            data-id="{{ $menu->id }}" data-name="{{ $menu->name }}" data-price="{{ $menu->harga }}"
            data-description="{{ $menu->deskripsi }}" data-image="{{ $menu->image }}"
            data-nutrition="{{ $menu->nutrisi }}">
            Details
        </button>
    </div>
@endforeach
