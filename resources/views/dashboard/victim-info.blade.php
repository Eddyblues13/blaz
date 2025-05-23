@extends('layouts.app')

@section('title', 'Hacked Wallets')

@section('content')
    <h1 style="margin: 10px; font-size:1.8em">Hacked Wallets</h1>
    
    <div class="victims-list">
        <table>
            <thead>
                <tr>
                    <th>Wallet Address</th>
                    <th>Balance</th>
                    <th>Date Added</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($victims as $victim)
                <tr>
                    <td>{{ substr($victim->wallet_address, 0, 6) }}...{{ substr($victim->wallet_address, -4) }}</td>
                    <td>${{ number_format($victim->balance, 2) }}</td>
                    <td>{{ $victim->created_at->format('Y-m-d') }}</td>
                    <td class="status-{{ strtolower($victim->status) }}">{{ $victim->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No wallet information found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('floating-button')
    <div class="floating-button">
        <a class="btn btn-float" href="https://t.me/+jPIwwRRfQP9kMmU0"><i class="fas fa-paper-plane"></i> Message Us</a>
    </div>
@endsection