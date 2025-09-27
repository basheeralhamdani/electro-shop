<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Electro Shop — Modern Template</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <!-- Ionicons CDN -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="{{ asset('Css/Home.css') }}" />
    <link rel="stylesheet" href="{{ asset('Css/orders.css') }}">

   
    </style>

    <meta name="description" content="Electro Shop — modern responsive e-commerce template." />
</head>

<!-- 👇 Added conditional class -->

<body class="@auth logged-in @else guest @endauth">

    <!-- Header -->
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ url('/') }}">Electro<span>Shop</span></a>

            <form class="search" action="{{ route('search') }}" method="GET" role="search" aria-label="Search products">
                <input id="search-input" name="q" type="search" placeholder="Search products..." />
                <button aria-label="Search"><ion-icon name="search-outline"></ion-icon></button>
            </form>

            <nav class="main-nav" aria-label="Main navigation">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/#deals') }}">Deals</a></li>
                    <li><a href="{{ url('/#products') }}">Our Products</a></li>
                    <li><a href="{{ url('/#contact') }}">Contact</a></li>
                </ul>
            </nav>

            <!-- Auth Links & Cart -->
            <div class="auth-links-cart" style="margin-left: auto; display: flex; align-items: center; gap: 18px;">
                @auth
                <a href="{{ route('cart.index') }}" class="header-cart-icon" title="My Cart">
                    <ion-icon name="cart-outline"></ion-icon>
                    @php $cartCount = Auth::user()->cartItems()->count(); @endphp
                    @if($cartCount > 0)
                    <span id="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                @endauth

                @guest
                {{-- Guest links --}}
                <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                @if (Route::has('register'))<a href="{{ route('register') }}" class="btn btn-primary">Register</a>@endif
                @else
                {{-- Logged-in user dropdown --}}
                <div class="user-dropdown">
                    <button class="user-dropdown-toggle" id="userDropdownToggle">
                        <span>{{ Auth::user()->name }}</span>
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </button>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        @if(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        @else
                        <a href="{{ route('user.orders') }}">My Orders</a>
                        @endif
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endguest
            </div>
            <button class="mobile-toggle" aria-label="Open menu" id="mobileToggle"><ion-icon name="menu"></ion-icon></button>
        </div>

        <!-- Mobile drawer -->
        <div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
            <button class="mobile-close" id="mobileClose" aria-label="Close menu"><ion-icon name="close"></ion-icon></button>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/#deals') }}">Deals</a></li>
                <li><a href="{{ url('/#products') }}">Our Products</a></li>
                <li><a href="{{ url('/#contact') }}">Contact</a></li>
            </ul>
        </div>
    </header>

    <main>@yield('content')</main>

    <!-- Footer -->
    <footer id="contact" class="site-footer">
        <div class="container footer-grid">
            <div class="footer-col">
                <h4>About Electro</h4>
                <p>Reliable electronics and accessories. Fast shipping & support.</p>
            </div>
            <div class="footer-col">
                <h4>Products</h4>
                <ul>
                    <li><a href="#">Sell your Products</a></li>
                    <li><a href="#">Advertise</a></li>
                    <li><a href="#">Pricing</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Connect</h4>
                <div class="social"><a href="#"><ion-icon name="logo-facebook"></ion-icon></a><a href="#"><ion-icon name="logo-instagram"></ion-icon></a><a href="#"><ion-icon name="logo-youtube"></ion-icon></a><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright © Electro 2021 - 2028</p>
        </div>
    </footer>

    <script src="{{ asset('js/mobileDrawer.js') }}"></script>
    <script src="{{ asset('js/filter.js') }}"></script>
    <script src="{{ asset('js/addToCart.js') }}"></script>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');

        if (userDropdownToggle) {
            userDropdownToggle.addEventListener('click', function() {
                userDropdownMenu.classList.toggle('active');
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (userDropdownToggle && !userDropdownToggle.contains(event.target)) {
                userDropdownMenu.classList.remove('active');
            }
        });
    });
</script>

</html>