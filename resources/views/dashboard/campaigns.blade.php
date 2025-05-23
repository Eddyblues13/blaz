@extends('layouts.app')

@section('title', 'Mailing History')

@section('content')
<h1 style="margin: 10px; font-size:1.8em">Mailing History</h1>

<div class="campaigns-list">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Subject</th>
                <th>Recipients</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse(Auth::user()->campaigns as $campaign)
            <tr>
                <td>{{ $campaign->created_at->format('Y-m-d') }}</td>
                <td>{{ $campaign->subject }}</td>
                <td>{{ $campaign->recipients_count }}</td>
                <td class="status-{{ strtolower($campaign->status) }}">{{ $campaign->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No campaigns found</td>
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