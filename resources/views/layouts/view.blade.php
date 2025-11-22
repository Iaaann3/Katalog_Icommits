<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'iCommits')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* Header/Navbar */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 30px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-menu a {
            color: #4a5568;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.2s;
            position: relative;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            color: #2563eb;
        }

        .btn-contact {
            padding: 10px 28px;
            background: transparent;
            color: #2563eb;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border-radius: 25px;
            border: 2px solid #2563eb;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .btn-contact:hover {
            background: #2563eb;
            color: white;
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - 70px);
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 60px 40px 30px;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 50px;
        }

        .footer-brand {
            display: flex;
            align-items: flex-start;
            flex-direction: column;
        }

        .footer-brand img {
            height: 50px;
            width: auto;
            margin-bottom: 20px;
        }

        .footer-info {
            color: #bdc3c7;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .footer-info strong {
            color: #ecf0f1;
            display: inline-block;
            min-width: 60px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #fff;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 12px;
        }

        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-section a:hover {
            color: #3498db;
        }

        .footer-section a svg {
            width: 14px;
            height: 14px;
        }

        .social-networks {
            margin-top: 25px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #34495e;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icon:hover {
            background: #3498db;
            transform: translateY(-3px);
        }

        .social-icon svg {
            width: 18px;
            height: 18px;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 30px;
            border-top: 1px solid #34495e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #bdc3c7;
            font-size: 14px;
        }

        .footer-bottom a {
            color: #3498db;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
        }

        .mobile-toggle svg {
            width: 28px;
            height: 28px;
            stroke: #4a5568;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .navbar-container {
                padding: 0 20px;
            }

            .navbar-right {
                display: none;
            }

            .navbar-menu.active {
                display: flex !important;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background: white;
                padding: 20px;
                border-bottom: 1px solid #e5e7eb;
                gap: 20px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 999;
            }

            .mobile-toggle {
                display: block;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo di kiri -->
            <a href="/" class="navbar-brand">
                <img src="{{ asset('/assets/img/logo/icommits.jpg') }}" alt="iCommits Logo">
            </a>

            <!-- Tombol mobile toggle -->
            <button class="mobile-toggle" id="mobileToggle">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <!-- Menu + tombol di kanan -->
            <div class="navbar-right">
                <ul class="navbar-menu" id="navbarMenu">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Portofolio</a></li>
                    <li><a href="#">Katalog</a></li>
                    <li><a href="#">Layanan</a></li>
                </ul>
                <a href="#" class="btn-contact">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Brand Section -->
            <div class="footer-brand">
                <img src="{{ asset('/assets/img/logo/icommits.jpg') }}" alt="iCommits Logo">
                
                <div class="footer-info">
                    <strong>Alamat:</strong> Pinus Regency IV No. 30 Kota Bandung
                </div>
                <div class="footer-info">
                    <strong>Phone:</strong> +6285762205153
                </div>
                <div class="footer-info">
                    <strong>Email:</strong> info@icommits.co.id
                </div>

                <div class="social-networks">
                    <h4>Our Social Networks</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17 2H7a5 5 0 00-5 5v10a5 5 0 005 5h10a5 5 0 005-5V7a5 5 0 00-5-5z"></path>
                                <path d="M8.5 14.5l2.5-3 2.5 3.5L16 12l3 4.5H5z" fill="#2c3e50"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Useful Links -->
            <div class="footer-section">
                <h4>Useful Links</h4>
                <ul>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            About us
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Terms of service
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Privacy policy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Our Services -->
            <div class="footer-section">
                <h4>Our Services</h4>
                <ul>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Web Design
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Web Development
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Product Management
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Marketing
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            Graphic Design
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; Copyright <strong>iCommits</strong>. All Rights Reserved</p>
            <p>Designed by <a href="https://icommits.co.id" target="_blank">iCommits</a></p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const navbarMenu = document.getElementById('navbarMenu');
        const navbarRight = document.querySelector('.navbar-right');

        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            navbarMenu.classList.toggle('active');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.navbar-container')) {
                navbarMenu.classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>