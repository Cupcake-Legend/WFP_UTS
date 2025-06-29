@extends('layouts.main')

@section('content')
    <div class="container py-5">

        {{-- Judul Halaman --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-light">Profil Saya</h1>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: Untuk Informasi Utama --}}
            <div class="col-lg-4">

                {{-- Card Informasi Profil --}}
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

                {{-- Card Poin --}}
                <div class="card border-0 shadow-sm text-center mb-4">
                    <div class="card-body p-4">
                        <h6 class="text-muted mb-2">Poin Reward Anda</h6>
                        <h2 class="display-4 fw-bold">{{ $user->poin }}</h2>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: Untuk Riwayat --}}
            <div class="col-lg-8">

                {{-- Card Riwayat Order --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Riwayat Order</h5>
                        @if ($user->orders->count())
                            <ul class="list-group list-group-flush">
                                @foreach ($user->orders as $order)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div>
                                            <strong>Order #{{ $order->id }}</strong>
                                            <small class="d-block text-muted">
                                                @if ($order->created_at)
                                                    {{ $order->created_at->format('d M Y, H:i') }}
                                                @endif
                                            </small>
                                        </div>
                                        <span
                                            class="badge bg-primary rounded-pill">Rp{{ number_format($order->total ?? 0) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Anda belum memiliki riwayat order.</p>
                        @endif
                    </div>
                </div>

                {{-- Card Riwayat Reward --}}
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
                                            </div>
                                            <span class="badge bg-success rounded-pill">+{{ $rewardDetail->reward->poin }}
                                                Poin</span>
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
        </div>
    </div>
@endsection
