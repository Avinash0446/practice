@extends('layouts.app')
@section('content')
<style>
.subscription-section {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 30px;
}

.card {
    width: 260px;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.plan-name {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.plan-desc {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.plan-price {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.plan-price span {
    font-size: 14px;
    color: #888;
}

.btn-buy {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 6px;
    background-color: #0d6efd;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
}

.btn-buy:hover {
    background-color: #0b5ed7;
}
</style>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="flash-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<h1>Welocome ({{ auth()->user()->name }})</h1>
<h3>Your role is: {{ auth()->user()->getRoleNames()->first() }}</h3>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>
<a href="{{ route('profile') }}" class="btn btn-primary mt-3">
    View Profile
</a>
<div class="subscription-section">
    @foreach ($plans as $plan)
        <div class="card">

            <h3 class="plan-name">{{ $plan->name }}</h3>

            <p class="plan-desc">
                {{ $plan->description ?? 'No description available' }}
            </p>

            <div class="plan-price">
                ₹{{ $plan->price }}
                <span>/ {{ $plan->interval }}</span>
            </div>

            <!-- Buy Button -->
            <form action="{{ route('plans.subscribe', $plan->stripe_product_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-buy">
                    Buy Now
                </button>
            </form>

        </div>
    @endforeach
</div>
@endsection
@push('scripts')
    
@endpush