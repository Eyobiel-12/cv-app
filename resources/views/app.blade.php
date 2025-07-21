<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Serhat Yildirim</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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
            --color-navbar-bg: rgba(255,255,255,0.85);
            --color-navbar-text: #5f2eea;
            --color-card-bg: #fff;
            --color-card-shadow: 0 8px 32px rgba(95,46,234,0.10);
            
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
            --color-navbar-bg: rgba(24,24,36,0.92);
            --color-navbar-text: #a259c9;
            --color-card-bg: #232336;
            --color-card-shadow: 0 8px 32px rgba(162,89,201,0.10);
        }
        
        /* Smooth transitions for theme changes */
        body, .card, .modal-content, .form-control, .btn, .navbar, .modal-header, .modal-footer {
            transition: background-color var(--transition-speed), 
                        color var(--transition-speed), 
                        border-color var(--transition-speed),
                        box-shadow var(--transition-speed);
        }
        
        /* Project card hover effect */
        .project-card {
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(var(--color-primary-rgb), 0.15) !important;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

@include('componants.navbar')
@include('componants.loader')

<div class="" id="content-div">
    @yield('content')
</div>

@include('componants.footer')

<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
