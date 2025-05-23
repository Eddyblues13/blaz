@extends('layouts.app')

@section('title', 'Send Mail')

@section('content')
<div class="register-container">
    <h2>Send Mail</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('campaign.store') }}">
        @csrf

        <div class="form-group">
            <label for="email">Recipient Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            <div class="error-message">
                @error('email') {{ $message }} @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
            <div class="error-message">
                @error('subject') {{ $message }} @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
            <div class="error-message">
                @error('message') {{ $message }} @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Send Mail</button>
    </form>
</div>
@endsection

@section('floating-button')
<div class="floating-button">
    <a class="btn btn-float" href="https://t.me/+jPIwwRRfQP9kMmU0"><i class="fas fa-paper-plane"></i> Message Us</a>
</div>
@endsection

<style>
    .register-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .register-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #555;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }

    .error-message {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        background-color: #3490dc;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #2779bd;
    }

    .floating-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .btn-float {
        display: inline-block;
        padding: 12px 20px;
        background-color: #28a745;
        color: white;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
    }

    .btn-float:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    @media (max-width: 768px) {
        .register-container {
            margin: 20px 15px;
            padding: 15px;
        }

        .floating-button {
            bottom: 15px;
            right: 15px;
        }
    }
</style>