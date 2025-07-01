@extends('layouts.main')

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-light">Profil Saya</h1>
        </div>

        <div class="row">
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">{{ $user->name }}</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="bi bi-envelope-at-fill me-2 text-primary"></i>{{ $user->email }}
                            </li>
                            <li class="mb-2"><i class="bi bi-telephone-fill me-2 text-primary"></i>{{ $user->no_hp }}
                            </li>
                            <li class="mb-0"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>{{ $user->alamat }}</li>
                        </ul>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="card border-0 shadow-sm text-center mb-4">
                    <div class="card-body p-4">
                        <h6 class="text-muted mb-2">Poin Reward Anda</h6>
                        <h2 class="display-4 fw-bold">{{ $user->poin }}</h2>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Reward yang Dimiliki</h5>
                        @if ($user->rewards->count())
                            <ul class="list-group list-group-flush">
                                @foreach ($user->rewards as $rewardDetail)
                                    @if ($rewardDetail->reward)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <div>
                                                <strong>{{ $rewardDetail->reward->name }}</strong>
                                                <small class="d-block text-muted">
                                                    Status:
                                                    @if ($rewardDetail->is_claimed == 'YES')
                                                        <span class="text-success">Sudah Diklaim</span>
                                                    @else
                                                        <span class="text-warning">Belum Diklaim</span>
                                                    @endif
                                                </small>
                                                <small class = "d-block text-muted">Date:
                                                    <span
                                                        class = "text-success">{{ $rewardDetail->updated_at }}</span></small>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-success rounded-pill">+{{ $rewardDetail->reward->poin }}
                                                    Poin</span>

                                                @if ($rewardDetail->is_claimed !== 'YES')
                                                    <form action="{{ route('reward.claim', $rewardDetail->reward->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">Claim</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Anda belum memiliki reward.</p>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-lg-8">


                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Riwayat Order</h5>

                        <div class="accordion accordion-flush" id="orderHistoryAccordion">
                            {{-- @forelse($user->orders as $order) --}}
                            {{-- biar descending --}}
                            @forelse($user->orders->sortByDesc('created_at') as $order)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOrder{{ $order->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOrder{{ $order->id }}" aria-expanded="false"
                                            aria-controls="collapseOrder{{ $order->id }}">
                                            <div class="d-flex justify-content-between w-100">
                                                <div> <strong>Order #{{ $order->id }}</strong> <small
                                                        class="d-block text-muted">{{ $order->created_at?->format('d M Y, H:i') }}</small>
                                                    <span {{-- kalo process warna kuning kalau done jadi ijo --}}
                                                        class="badge @if ($order->status === 'PROCESS') bg-warning @elseif($order->status === 'DONE') bg-success @else bg-secondary @endif mt-1">
                                                        {{ $order->status }} </span>
                                                </div>
                                                <span
                                                    class="badge bg-primary rounded-pill align-self-center me-3">Rp{{ number_format($order->total ?? 0) }}</span>
                                            </div>
                                        </button>
                                    </h2>

                                    <div id="collapseOrder{{ $order->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOrder{{ $order->id }}"
                                        data-bs-parent="#orderHistoryAccordion">
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
                                                                Rp{{ number_format($detail->menu->harga ?? 0) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">Anda belum memiliki riwayat order.</p>
                            @endforelse
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
