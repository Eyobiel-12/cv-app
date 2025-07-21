<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Dashboard voor Serhat Yildirim Portfolio" />
    <meta name="author" content="Serhat Yildirim" />
    <title>Dashboard - Serhat Yildirim</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <script src="{{asset('js/axios.min.js')}}"></script>
    
    <style>
        :root {
            /* Base colors */
            --color-bg: #fff;
            --color-bg-alt: #f6f6fa;
            --color-text: #222;
            --color-text-rgb: 34, 34, 34;
            --color-primary: #5f2eea;
            --color-primary-rgb: 95, 46, 234;
            --color-primary-alt: #a259c9;
            --color-navbar-bg: rgba(255,255,255,0.95);
            --color-navbar-text: #5f2eea;
            --color-card-bg: #fff;
            --color-card-shadow: 0 8px 32px rgba(95,46,234,0.10);
            --color-sidebar-bg: #f8f9fa;
            --color-sidebar-active: #5f2eea;
            
            /* Transition speeds */
            --transition-speed: 0.3s;
        }
        
        body.darkmode {
            --color-bg: #181824;
            --color-bg-alt: #232336;
            --color-text: #f3f3fa;
            --color-text-rgb: 243, 243, 250;
            --color-primary: #a259c9;
            --color-primary-rgb: 162, 89, 201;
            --color-primary-alt: #5f2eea;
            --color-navbar-bg: rgba(24,24,36,0.98);
            --color-navbar-text: #a259c9;
            --color-card-bg: #232336;
            --color-card-shadow: 0 8px 32px rgba(162,89,201,0.10);
            --color-sidebar-bg: #232336;
            --color-sidebar-active: #a259c9;
        }
        
        /* Smooth transitions for theme changes */
        body, .card, .modal-content, .form-control, .btn, .navbar, .modal-header, .modal-footer {
            transition: background-color var(--transition-speed), 
                        color var(--transition-speed), 
                        border-color var(--transition-speed),
                        box-shadow var(--transition-speed);
        }
        
        /* Dashboard specifieke stijlen */
        .dashboard-navbar {
            background-color: var(--color-navbar-bg);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(var(--color-primary-rgb), 0.1);
            border-bottom: 1px solid rgba(var(--color-primary-rgb), 0.1);
        }
        
        .dashboard-navbar .nav-link {
            color: var(--color-text);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            margin: 0 0.25rem;
        }
        
        .dashboard-navbar .nav-link:hover {
            background-color: rgba(var(--color-primary-rgb), 0.1);
            color: var(--color-primary);
        }
        
        .dashboard-navbar .nav-link.active {
            background-color: var(--color-primary);
            color: white;
        }
        
        .dashboard-navbar .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg, var(--color-primary), var(--color-primary-alt));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .dashboard-content {
            padding-top: 5rem;
            min-height: calc(100vh - 56px);
            background-color: var(--color-bg);
        }
        
        /* Responsive aanpassingen */
        @media (max-width: 991.98px) {
            .dashboard-navbar .navbar-collapse {
                background-color: var(--color-navbar-bg);
                border-radius: 0.5rem;
                padding: 1rem;
                margin-top: 0.5rem;
                box-shadow: 0 4px 15px rgba(var(--color-primary-rgb), 0.1);
            }
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Dashboard navigatiebalk -->
    <nav class="navbar navbar-expand-lg fixed-top dashboard-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>{{ __('messages.dashboard') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDashboard" aria-controls="navbarDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarDashboard">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door me-1"></i>{{ __('messages.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.projects*') ? 'active' : '' }}" href="{{ route('dashboard.projects') }}">
                            <i class="bi bi-kanban me-1"></i>{{ __('messages.projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.contacts*') ? 'active' : '' }}" href="{{ route('dashboard.contacts') }}">
                            <i class="bi bi-envelope me-1"></i>{{ __('messages.contact') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.downloads*') ? 'active' : '' }}" href="{{ route('dashboard.downloads') }}">
                            <i class="bi bi-graph-up me-1"></i>{{ __('messages.download_cv') }}
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" target="_blank">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Website
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="theme-toggle">
                            <i class="bi bi-moon me-1" id="theme-icon"></i>{{ __('messages.dark_mode') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link text-danger">
                                <i class="bi bi-box-arrow-right me-1"></i>{{ __('messages.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard content -->
    <main class="dashboard-content">
        <div class="container pt-4">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                </div>
            @endif
            
            @yield('dashboard-content')
        </div>
    </main>

    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Thema wisselen
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            
            // Check voor opgeslagen thema voorkeur
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('darkmode');
                themeIcon.classList.replace('bi-moon', 'bi-sun');
            }
            
            // Event listener voor thema toggle
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    document.body.classList.toggle('darkmode');
                    
                    // Update icon
                    if (document.body.classList.contains('darkmode')) {
                        themeIcon.classList.replace('bi-moon', 'bi-sun');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        themeIcon.classList.replace('bi-sun', 'bi-moon');
                        localStorage.setItem('theme', 'light');
                    }
                });
            }
        });
    </script>
    
    @yield('dashboard-scripts')
</body>
</html> 