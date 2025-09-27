<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - ElectroShop</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="{{ asset('Css/admin.css') }}">
    <style>.admin-mobile-toggle { display: none; }</style>
</head>
<body>
    <div class="page-wrapper">
        <aside class="sidebar" id="adminSidebar">
            <a class="brand" href="{{ route('home') }}">Electro<span>Shop</span></a>
<nav class="sidebar-nav">
    <ul>
        {{-- أضف هذا الرابط الجديد --}}
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <ion-icon name="grid-outline"></ion-icon>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <ion-icon name="cube-outline"></ion-icon>
                <span>Products</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <ion-icon name="folder-outline"></ion-icon>
                <span>Categories</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <ion-icon name="receipt-outline"></ion-icon>
                <span>Orders</span>
            </a>
        </li>
    </ul>
    <ul style="margin-top: auto;">
        <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 20px 0;">
        <li><a href="{{ route('home') }}" target="_blank"><ion-icon name="eye-outline"></ion-icon><span>View Site</span></a></li>
    </ul>
</nav>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <button class="admin-mobile-toggle" id="adminMenuToggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </button>
                <div class="user-menu"><a href="#">{{ Auth::user()->name }}</a></div>
            </header>
            <div class="page-content">
                @if(session('success'))
                    <div class="alert" style="background-color: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 8px; margin-bottom: 20px;">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const adminSidebar = document.getElementById('adminSidebar');
        const adminMenuToggle = document.getElementById('adminMenuToggle');
        if (adminMenuToggle) {
            adminMenuToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('active');
            });
        }
        document.addEventListener('click', (event) => {
            if (adminSidebar && adminSidebar.classList.contains('active') && !adminSidebar.contains(event.target) && !adminMenuToggle.contains(event.target)) {
                adminSidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>