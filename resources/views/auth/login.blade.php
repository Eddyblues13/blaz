<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blazespom</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --error-color: #dc3545;
            --text-color: #333;
            --light-gray: #f3f4f6;
            --border-color: #d1d5db;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: var(--text-color);
            line-height: 1.6;
        }

        header {
            padding: 1.5rem;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .logo i {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .login-container {
            max-width: 28rem;
            margin: 3rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            width: 100%;
        }

        .btn:hover {
            background-color: #4338ca;
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .text-center {
            text-align: center;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            height: 1rem;
        }

        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            margin-left: 0.5rem;
            vertical-align: middle;
            border: 0.15em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        .hidden {
            display: none;
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <header>
        <a href="{{ url('/') }}" class="logo">
            <i class="fas fa-cube"></i>
            <span>Blazespom</span>
        </a>
    </header>

    <div class="login-container">
        <h2>Login to your account</h2>
        <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="id_email">Email:</label>
                <input type="email" name="email" required id="id_email" value="{{ old('email') }}" autofocus>
                <div class="error-message" id="email_error"></div>
            </div>

            <div class="form-group">
                <label for="id_password">Password:</label>
                <input type="password" name="password" autocomplete="current-password" required id="id_password">
                <div class="error-message" id="password_error"></div>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <button type="submit" class="btn" id="submitBtn">
                <span id="btnText">Login</span>
                <div id="spinner" class="spinner-border hidden"></div>
            </button>
        </form>

        <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>

    <footer>
        <p>Copyright {{ date('Y') }} Blazespom. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                $('#submitBtn').prop('disabled', true);
                $('#btnText').text('Authenticating...');
                $('#spinner').removeClass('hidden');
                
                // Clear previous errors
                $('.error-message').text('');
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr) {
                        $('#submitBtn').prop('disabled', false);
                        $('#btnText').text('Login');
                        $('#spinner').addClass('hidden');
                        
                        if(xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '_error').text(value[0]);
                            });
                        } else {
                            $('#password_error').text('Invalid credentials. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>