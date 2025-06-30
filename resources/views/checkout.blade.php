@extends('layouts.main')
@vite('resources/css/nutrition.css')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

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
                                $porsi = session('cart')[$menu->id]['porsi'] ?? 'Medium';
                                $multiplier = match ($porsi) {
                                    'Small' => 0.9,
                                    'Large' => 1.2,
                                    default => 1.0,
                                };
                                $subtotal = $menu->harga * $menu->quantity * $multiplier;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td class = "menu-price" data-price={{ $menu->harga }}>
                                    Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>
                                    <input type="number" name="order_details[{{ $index }}][quantity]"
                                        value="{{ $menu->quantity }}" min="1" class="form-control quantity-input"
                                        required>
                                    <input type="hidden" name="order_details[{{ $index }}][menu_id]"
                                        value="{{ $menu->id }}">
                                </td>
                                <td>
                                    <select name="order_details[{{ $index }}][porsi]"
                                        class="form-select porsi-select" required>
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

                                <td class = "menu-subtotal">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
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
                                <span class = "grand-total">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>
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
            let grandTotal = 0;

            $(".quantity-input").each(function() {
                let row = $(this).closest("tr");
                let menuId = $(this).data("id");
                let quantity = parseInt($(this).val());
                let price = parseFloat(row.find(".menu-price").data("price"));
                let porsi = row.find(".porsi-select").val();

                let multiplier = 1.0;
                if (porsi === "Small") multiplier = 0.9;
                else if (porsi === "Large") multiplier = 1.2;

                let subtotal = quantity * price * multiplier;
                row.find(".menu-subtotal").text("Rp" + subtotal.toLocaleString("id-ID"));

                grandTotal += subtotal;

                quantities[menuId] = quantity;
                porsis[menuId] = porsi;
            });

            $(".grand-total").text("Rp" + grandTotal.toLocaleString("id-ID"));
            $("input[name=total]").val(grandTotal);

            $.ajax({
                url: "{{ route('update.cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    quantities: quantities,
                    porsis: porsis
                },
                success: function(response) {
                    console.log("Cart updated successfully");
                },
                error: function() {
                    console.error("Cart update failed");
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
