@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<h1 style="margin: 10px; font-size:1.8em">Change Password</h1>

<div class="password-form">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="update-button">Update Password</button>
    </form>
</div>
@endsection

@section('floating-button')
<div class="floating-button">
    <a class="btn btn-float" href="https://t.me/+jPIwwRRfQP9kMmU0"><i class="fas fa-paper-plane"></i> Message Us</a>
</div>
@endsection