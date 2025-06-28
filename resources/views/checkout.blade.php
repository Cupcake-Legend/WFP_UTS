@extends('layouts.main')
@vite('resources/css/nutrition.css')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (count($menus) === 0)
            <p>Your cart is empty.</p>
        @else
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                {{-- Payment Method --}}
                <div class="mb-3">
                    <label for="payment_method_id" class="form-label">Payment Method</label>
                    <select name="payment_method_id" id="payment_method_id" class="form-select" required>
                        @foreach ($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Order Method --}}
                <div class="mb-3">
                    <label class="form-label">Order Method</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="order_method" value="DINEIN" checked>
                        <label class="form-check-label">Dine In</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="order_method" value="TAKEAWAY">
                        <label class="form-check-label">Takeaway</label>
                    </div>
                </div>

                {{-- Cart Table --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Porsi</th>
                            <th>Notes</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($menus as $index => $menu)
                            @php
                                $subtotal = $menu->harga * $menu->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" name="order_details[{{ $index }}][quantity]"
                                        value="{{ $menu->quantity }}" min="1" class="form-control" required>
                                    <input type="hidden" name="order_details[{{ $index }}][menu_id]"
                                        value="{{ $menu->id }}">
                                </td>
                                <td>
                                    <select name="order_details[{{ $index }}][porsi]" class="form-select" required>
                                        @foreach (['Small', 'Medium', 'Large'] as $size)
                                            <option value="{{ $size }}"
                                                {{ (session('cart')[$menu->id]['porsi'] ?? 'Medium') === $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="order_details[{{ $index }}][notes]"
                                        class="form-control" placeholder="Optional">
                                </td>

                                <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="removeFromCart({{ $menu->id }}, this)">
                                        Remove
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-end fw-bold">Total</td>
                            <td>
                                Rp{{ number_format($total, 0, ',', '.') }}
                                <input type="hidden" name="total" value="{{ $total }}">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="status" value="PROCESS">

                <button type="submit" class="btn btn-success">Place Order</button>
            </form>
        @endif
    </div>
@endsection


@section('scripts')
    <script>
        function updateCart() {
            let quantities = {};
            let porsis = {};

            $(".quantity-input").each(function() {
                let menuId = $(this).data("id");
                quantities[menuId] = $(this).val();
            });

            $(".porsi-select").each(function() {
                let menuId = $(this).data("id");
                porsis[menuId] = $(this).val();
            });

            $.ajax({
                url: "{{ route('update.cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    quantities: quantities,
                    porsis: porsis
                },
                success: function(response) {
                    console.log('Cart updated successfully');
                    location.reload();
                },
                error: function() {
                    console.error('Cart update failed');
                }
            });
        }

        function removeFromCart(menuId, button) {
            if (!confirm('Remove this item from cart?')) return;

            fetch(`{{ url('/cart/remove') }}/${menuId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to remove item.');
                    }

                    const row = button.closest('tr');
                    row.remove();

                    location.reload();
                })
                .catch(error => {
                    console.error(error);
                    alert('Could not remove item from cart.');
                });
        }


        $(document).on("change", ".quantity-input, .porsi-select", updateCart);
    </script>
@endsection
