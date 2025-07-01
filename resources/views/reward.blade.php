@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Daftar Reward</h2>

        @if (session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        @if ($rewards->count())
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($rewards as $reward)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title">{{ $reward->name }}</h5>
                                <p class="card-text">
                                    <strong>Poin:</strong> {{ $reward->poin }}<br>
                                    <strong>Menu:</strong> {{ $reward->menu->name ?? '-' }}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <form action="{{ route('reward_details.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" class="nav-btn w-100">Buy Reward</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Tidak ada reward tersedia saat ini.</p>
        @endif
    </div>
@endsection
