@extends('layouts.app')

@section('title', 'Bulk Mail')

@section('content')
<div class="register-container">
    <h2>Bulk Mail</h2>
    <form method="POST" action="{{ route('campaign.store.bulk') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" class="@error('subject') is-invalid @enderror"
                value="{{ old('subject') }}" required>
            <div class="error-message">
                @error('subject') {{ $message }} @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="6" class="@error('message') is-invalid @enderror"
                required>{{ old('message') }}</textarea>
            <div class="error-message">
                @error('message') {{ $message }} @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="recipients">Recipients (CSV file):</label>
            <input type="file" id="recipients" name="recipients" accept=".csv"
                class="@error('recipients') is-invalid @enderror" required>
            <div class="error-message">
                @error('recipients') {{ $message }} @enderror
            </div>
            <small class="form-text text-muted">
                Upload a CSV file containing email addresses in the first column.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Send Bulk Mail
        </button>
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
        max-width: 800px;
        margin: 30px auto;
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .register-container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
        font-size: 1.8em;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #34495e;
    }

    .form-group input[type="text"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-group input[type="file"] {
        padding: 8px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .form-group textarea {
        min-height: 200px;
        resize: vertical;
        line-height: 1.6;
    }

    .error-message {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }

    .is-invalid {
        border-color: #e74c3c !important;
    }

    .btn-primary {
        width: 100%;
        padding: 14px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .form-text {
        display: block;
        margin-top: 8px;
        color: #7f8c8d;
        font-size: 14px;
    }

    .floating-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }

    .btn-float {
        display: inline-block;
        padding: 14px 24px;
        background-color: #2ecc71;
        color: white;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-float:hover {
        background-color: #27ae60;
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .register-container {
            margin: 20px;
            padding: 20px;
        }

        .register-container h2 {
            font-size: 1.5em;
        }

        .floating-button {
            bottom: 20px;
            right: 20px;
        }

        .btn-float {
            padding: 12px 20px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .register-container {
            margin: 15px;
            padding: 15px;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            padding: 10px;
        }
    }
</style>