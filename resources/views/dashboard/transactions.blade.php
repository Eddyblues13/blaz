@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
<h1 style="margin: 10px; font-size:1.8em">Transaction History</h1>

<div class="transactions-list">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse(Auth::user()->transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                <td>{{ $transaction->transaction_id }}</td>
                <td>${{ number_format($transaction->amount, 2) }}</td>
                <td class="status-{{ strtolower($transaction->status) }}">{{ $transaction->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No transactions found</td>
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