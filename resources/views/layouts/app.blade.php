<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f4f6f9;
            }
            .wrapper {
                display: flex;
                width: 100%;
                align-items: stretch;
            }
            #sidebar {
                min-width: 250px;
                max-width: 250px;
                background: #1a233a;
                color: #fff;
                transition: all 0.3s;
                min-height: 100vh;
            }
            #sidebar .sidebar-header {
                padding: 20px;
                background: #1d2b45;
                text-align: center;
                font-weight: bold;
                font-size: 1.2rem;
            }
            #sidebar ul.components {
                padding: 20px 0;
            }
            #sidebar ul li a {
                padding: 10px 20px;
                font-size: 1.1em;
                display: block;
                color: #aebce4;
                text-decoration: none;
                transition: all 0.3s;
            }
            #sidebar ul li a:hover {
                color: #fff;
                background: #27375a;
            }
            #sidebar ul li a i {
                margin-right: 10px;
            }
            #content {
                width: 100%;
                padding: 20px;
                min-height: 100vh;
            }
            .navbar-custom {
                background: #fff;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                margin-bottom: 20px;
                padding: 15px 20px;
                border-radius: 8px;
            }
            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.05);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            }
            .stat-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }
            .stat-card-2 {
                background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
                color: #1a233a;
            }
            .stat-card-3 {
                background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
                color: #1a233a;
            }
            .stat-card-4 {
                background: linear-gradient(135deg, #5ee7df 0%, #b490ca 100%);
                color: white;
            }
        </style>
        
        @stack('styles')
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <i class="fa-solid fa-truck-fast me-2"></i> RoutePlan Pro
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('centers.index') }}"><i class="fa-solid fa-building"></i> Delivery Centers</a>
                    </li>
                    <li>
                        <a href="{{ route('vehicles.index') }}"><i class="fa-solid fa-truck"></i> Vehicles</a>
                    </li>
                    <li>
                        <a href="{{ route('drivers.index') }}"><i class="fa-solid fa-id-card"></i> Drivers</a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}"><i class="fa-solid fa-box"></i> Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('route-planning.index') }}"><i class="fa-solid fa-map-location-dot"></i> Route Planning</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <a href="#" onclick="document.getElementById('logout-form').submit()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-dark">@yield('header', 'Dashboard')</h4>
                    <div>
                        <span class="text-muted"><i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name }}</span>
                    </div>
                </nav>

                <div class="container-fluid px-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        @stack('scripts')
    </body>
</html>
