@extends('layouts.app')

@section('title', 'Subscription Plans')

@section('content')
<h1 style="margin: 10px; font-size:1.8em">Subscription Plans</h1>

<div class="plans-grid">
    @foreach($plans as $plan)
    <div class="plan-card">
        <h2>{{ $plan->name }}</h2>
        <p class="price">${{ number_format($plan->price, 2) }}/month</p>
        <ul class="features">
            @foreach(explode(',', $plan->features) as $feature)
            <li>{{ trim($feature) }}</li>
            @endforeach
        </ul>
        <a href="{{ route('subscription.subscribe', $plan->id) }}" class="subscribe-button">
            Subscribe
        </a>
    </div>
    @endforeach
</div>
@endsection

@section('floating-button')
<div class="floating-button">
    <a class="btn btn-float" href="https://t.me/+jPIwwRRfQP9kMmU0"><i class="fas fa-paper-plane"></i> Message Us</a>
</div>
@endsection