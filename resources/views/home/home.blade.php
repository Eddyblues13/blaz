<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blazespom</title>
    <link href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary: #6366f1;
            --background: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --text-secondary: #475569;
            --accent: #0ea5e9;
            --success: #16a34a;
            --warning: #f59e0b;
            --error: #dc2626;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text);
            text-decoration: none;
        }

        .logo span {
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            align-items: center;
        }

        .nav-group {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
            padding: 0.5rem 0;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), var(--secondary));
            transition: var(--transition);
            border-radius: 2px;
        }

        .nav-link:hover {
            color: var(--text);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-left: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 2px solid rgba(0, 0, 0, 0.1);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.05);
        }

        /* Hero Section */
        .hero {
            padding: 12rem 0 8rem;
            background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.08), transparent 60%),
                radial-gradient(circle at bottom left, rgba(59, 130, 246, 0.08), transparent 60%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: url('static/images/hero-image.jpg') center/cover no-repeat;
            opacity: 0.08;
            z-index: -1;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
        }

        /* Section Titles */
        .section {
            padding: 8rem 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-title p {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        /* Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--surface);
            padding: 2.5rem;
            border-radius: 1rem;
            transition: var(--transition);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: var(--transition);
            z-index: 0;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-card:hover::before {
            opacity: 0.06;
        }

        .feature-card * {
            position: relative;
            z-index: 1;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .feature-card p {
            color: var(--text-secondary);
        }

        /* FAQ */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--surface);
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            padding: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        }

        .faq-item:hover {
            border-color: var(--primary);
            transform: translateX(5px);
        }

        .faq-item h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .faq-item p {
            color: var(--text-secondary);
        }

        /* Footer */
        footer {
            background: var(--surface);
            padding: 4rem 0;
            margin-top: 4rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent);
        }

        /* Floating Button */
        .floating-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .btn-float {
            padding: 10px;
            text-decoration: none;
            border-radius: 50%;
            background-color: #ffffff;
            color: var(--primary);
            border: 1px solid #cbd5e1;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .btn-float:hover {
            background-color: #eff6ff;
            transform: scale(1.1);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Adjustments */
        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero h1 {
                font-size: 3rem;
            }

            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 8rem 0 6rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .section {
                padding: 4rem 0;
            }

            .footer-content {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }

            .about-section {
                padding: 2rem;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="icon" href="static/images/favicon.ico">

</head>

<body>
    <header>
        <div class="container header-content">
            <a href="#" class="logo">
                <i class="fas fa-cube"></i>
                <span>Blazespom</span>
            </a>
            <nav class="nav-links">
                <div class="nav-group">
                    <a href="#features" class="nav-link">Features</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#how-it-works" class="nav-link">How it Works</a>
                    <a href="#faq" class="nav-link">FAQ</a>
                </div>
                <div class="btn-group">
                    <a href="{{route('login')}}" class="btn btn-outline">Sign In</a>
                    <a href="{{route('register')}}" class="btn btn-primary">Get Started <i
                            class="fas fa-arrow-right"></i></a>
                </div>
            </nav>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <section class="hero">
        <div class="container hero-content">
            <h1>Next Generation Wallet Cracking Tools</h1>
            <p>Empower your blockchain journey with advanced tools designed for maximum efficiency.</p>
            <div class="btn-group">
                <a href="{{route('register')}}" class="btn btn-primary">Start Exploring <i
                        class="fas fa-rocket"></i></a>
                <a href="{{route('login')}}" class="btn btn-outline">Login <i class="fas fa-play"></i></a>
            </div>
        </div>
    </section>

    <section id="features" class="section">
        <div class="container">
            <div class="section-title">
                <h2>Powerful Features</h2>
                <p>Everything you need to explore and interact with advanced mailing technology</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-search feature-icon"></i>
                    <h3>Blockchain Explorer</h3>
                    <p>Advanced tools for cracking and analyzing wallet transactions with real-time updates.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bolt feature-icon"></i>
                    <h3>Transaction Accelerator</h3>
                    <p>Boost your crypto wallet cracking speeds with our cutting-edge acceleration technology.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell feature-icon"></i>
                    <h3>Smart Notifications</h3>
                    <p>Stay informed with customizable alerts for your blockchain activities.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="how-it-works" class="section">
        <div class="container">
            <div class="section-title">
                <h2>How It Works</h2>
                <p>Get started in three simple steps</p>
            </div>

            <!-- Video Section -->
            <div class="video-container">
                <video width="100%" max-width="100%" height="auto" controls>
                    <source src="static/images/tutorial.MP4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-user-plus feature-icon"></i>
                    <h3>Create Account</h3>
                    <p>Sign up in seconds with just your email address and start exploring.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-tools feature-icon"></i>
                    <h3>Choose Your Tools</h3>
                    <p>Select from our suite of professional mailing tools.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line feature-icon"></i>
                    <h3>Track Progress</h3>
                    <p>Monitor your mailing activities</p>
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="section">
        <div class="container">
            <div class="about-section">
                <div class="about-grid">
                    <div class="about-content">
                        <h2>Revolutionizing Blockchain Technology</h2>
                        <p>Blazespom is leading the way in blockchain innovation, providing cutting-edge tools and
                            solutions for developers, traders, and enthusiasts.</p>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <h3>100K+</h3>
                                <p>Active Users</p>
                            </div>
                            <div class="stat-item">
                                <h3>5M+</h3>
                                <p>Transactions Processed</p>
                            </div>
                            <div class="stat-item">
                                <h3>99.9%</h3>
                                <p>Uptime</p>
                            </div>
                            <div class="stat-item">
                                <h3>24/7</h3>
                                <p>Support Available</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="section">
        <div class="container">
            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                <p>Get answers to common questions about Blazespom</p>
            </div>
            <div class="faq-container">
                <div class="faq-item">
                    <h3>What is Blazespom?</h3>
                    <p>Blazespom is a comprehensive suite of mailing tools designed to help users interact with and
                        retrieve wallet info more effectively.</p>
                </div>
                <div class="faq-item">
                    <h3>How secure is Blazespom?</h3>
                    <p>We implement industry-leading security measures, including end-to-end encryption and regular
                        security audits to ensure your data remains protected.</p>
                </div>
                <div class="faq-item">
                    <h3>What cryptocurrencies do you support?</h3>
                    <p>Blazespom supports all major cryptocurrencies and blockchain networks, including Bitcoin,
                        Ethereum, and other popular chains.</p>
                </div>
                <div class="faq-item">
                    <h3>How do I get started?</h3>
                    <p>Simply create an account, verify your email, and you'll have immediate access to our suite of
                        blockchain tools.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container footer-content">
            <div class="footer-brand">
                <a href="#" class="logo">
                    <i class="fas fa-cube"></i>
                    <span>Blazespom</span>
                </a>
                <p style="color: var(--text-secondary); margin-top: 1rem;">Empowering the future of blockchain
                    technology</p>
            </div>
            <div class="footer-links">
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#how-it-works">How it Works</a>
                <a href="#faq">FAQ</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <div class="nav-group">
            <a href="#features" class="nav-link">Features</a>
            <a href="#about" class="nav-link">About</a>
            <a href="#how-it-works" class="nav-link">How it Works</a>
            <a href="#faq" class="nav-link">FAQ</a>
        </div>
        <div class="btn-group">
            <a href="{{route('login')}}" class="btn btn-outline">Sign In</a>
            <a href="{{route('register')}}" class="btn btn-primary">Get Started</a>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="floating-button">
        <a class="btn btn-float" href="https://t.me/+QgoITyWzYiJiODc8<i class=" fas fa-paper-plane"></i> Message Us</a>
    </div>
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const mobileNav = document.querySelector('.mobile-nav');
        const overlay = document.querySelector('.overlay');

        function toggleMobileMenu() {
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
        }

        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);

        // Close mobile menu when clicking nav links
        document.querySelectorAll('.mobile-nav .nav-link').forEach(link => {
            link.addEventListener('click', toggleMobileMenu);
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>