@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4">Riwayat Order</h3>

        {{-- Filter Dropdown --}}
        <form method="GET" action="{{ route('history') }}" class="mb-4">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="PROCESS" {{ $status == 'PROCESS' ? 'selected' : '' }}>Ongoing Order</option>
                        <option value="DONE" {{ $status == 'DONE' ? 'selected' : '' }}>Finished</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="accordion accordion-flush" id="orderAccordion">
            @forelse($orders as $order)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $order->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $order->id }}">
                            <div class="d-flex justify-content-between w-100">
                                <div>
                                    <strong>Order #{{ $order->id }}</strong>
                                    <small class="d-block text-muted">
                                        {{ $order->created_at?->format('d M Y, H:i') }}
                                    </small>
                                    <span
                                        class="badge 
                                    @if ($order->status === 'PROCESS') bg-warning 
                                    @elseif($order->status === 'DONE') bg-success 
                                    @else bg-secondary @endif mt-1">
                                        {{ $order->status }}
                                    </span>
                                </div>
                                <span class="badge bg-primary rounded-pill align-self-center me-3">
                                    Rp{{ number_format($order->total ?? 0) }}
                                </span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $order->id }}" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            <h6 class="mb-3">Detail Pesanan:</h6>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-end">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->menu->name ?? 'Menu Dihapus' }}</td>
                                            <td class="text-center">{{ $detail->quantity }}</td>
                                            <td class="text-end">
                                                Rp{{ number_format($detail->menu->harga ?? 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada order dengan status ini.</p>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
