<!-- Navigation Ultra Modern -->
<div class="navbar-brand-left position-absolute top-0 start-0 ps-5 pt-4" style="z-index:10;">
    <a href="{{url('/')}}" class="brand-logo-link">
        <span class="brand-logo fw-bold text-uppercase">SERHAT.</span>
    </a>
</div>
<nav class="navbar navbar-expand-lg custom-navbar shadow-lg py-3 justify-content-center">
    <div class="container px-4 justify-content-center">
        <!-- Mobile Brand Logo (hidden on desktop) -->
        <a href="{{url('/')}}" class="navbar-brand d-lg-none mobile-brand-logo">
            <span class="brand-logo fw-bold text-uppercase">SERHAT.</span>
        </a>
        
        <!-- Mobile Controls (hidden on desktop) -->
        <div class="d-lg-none mobile-controls">
            <form id="lang-switch-form-mobile" action="{{ route('lang.switch') }}" method="POST" class="d-inline me-2">
                @csrf
                <input type="hidden" name="lang" value="{{ app()->getLocale() === 'en' ? 'nl' : 'en' }}">
                <button type="submit" class="btn btn-outline-secondary mobile-control-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ app()->getLocale() === 'en' ? 'Nederlands' : 'English' }}">
                    @if(app()->getLocale() === 'en')
                        <img src="https://cdn.jsdelivr.net/npm/svg-country-flags@1.2.10/svg/nl.svg" alt="Nederlands" class="lang-flag-img">
                    @else
                        <img src="https://cdn.jsdelivr.net/npm/svg-country-flags@1.2.10/svg/gb.svg" alt="English" class="lang-flag-img">
                    @endif
                </button>
            </form>
            <button id="theme-toggle-mobile" class="btn btn-outline-secondary mobile-control-btn me-2">
                <i id="theme-icon-mobile" class="bi bi-moon"></i>
            </button>
        </div>
        
        <!-- Hamburger Menu Button -->
        <button class="navbar-toggler mobile-toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <!-- Desktop Menu -->
            <ul class="navbar-nav mb-2 mb-lg-0 gap-2 align-items-center d-none d-lg-flex">
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/')}}">{{ __('messages.home') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/resume')}}">{{ __('messages.cv') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/services')}}">{{ __('messages.services') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/projects')}}">{{ __('messages.projects') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/contact')}}">{{ __('messages.contact') }}</a></li>
                
                <!-- Desktop Controls -->
                <li class="nav-item">
                    <form id="lang-switch-form" action="{{ route('lang.switch') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="lang" value="{{ app()->getLocale() === 'en' ? 'nl' : 'en' }}">
                        <button type="submit" class="btn btn-outline-secondary ms-2 lang-flag-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ app()->getLocale() === 'en' ? 'Nederlands' : 'English' }}">
                            @if(app()->getLocale() === 'en')
                                <img src="https://cdn.jsdelivr.net/npm/svg-country-flags@1.2.10/svg/nl.svg" alt="Nederlands" class="lang-flag-img">
                            @else
                                <img src="https://cdn.jsdelivr.net/npm/svg-country-flags@1.2.10/svg/gb.svg" alt="English" class="lang-flag-img">
                            @endif
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <button id="theme-toggle" class="btn btn-outline-secondary ms-2" style="border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i id="theme-icon" class="bi bi-moon"></i>
                    </button>
                </li>
            </ul>
            
            <!-- Mobile Menu -->
            <div class="mobile-menu-container d-lg-none">
                <div class="mobile-menu-card">
                    <div class="mobile-menu-header">
                        <h6 class="mobile-menu-title">{{ __('messages.navigation') }}</h6>
                        <div class="mobile-menu-divider"></div>
                    </div>
                    <ul class="mobile-menu-list">
                        <li class="mobile-menu-item">
                            <a href="{{url('/')}}" class="mobile-menu-link">
                                <i class="bi bi-house-door mobile-menu-icon"></i>
                                <span class="mobile-menu-text">{{ __('messages.home') }}</span>
                                <i class="bi bi-arrow-right mobile-menu-arrow"></i>
                            </a>
                        </li>
                        <li class="mobile-menu-item">
                            <a href="{{url('/resume')}}" class="mobile-menu-link">
                                <i class="bi bi-file-earmark-person mobile-menu-icon"></i>
                                <span class="mobile-menu-text">{{ __('messages.cv') }}</span>
                                <i class="bi bi-arrow-right mobile-menu-arrow"></i>
                            </a>
                        </li>
                        <li class="mobile-menu-item">
                            <a href="{{url('/services')}}" class="mobile-menu-link">
                                <i class="bi bi-gear mobile-menu-icon"></i>
                                <span class="mobile-menu-text">{{ __('messages.services') }}</span>
                                <i class="bi bi-arrow-right mobile-menu-arrow"></i>
                            </a>
                        </li>
                        <li class="mobile-menu-item">
                            <a href="{{url('/projects')}}" class="mobile-menu-link">
                                <i class="bi bi-folder2-open mobile-menu-icon"></i>
                                <span class="mobile-menu-text">{{ __('messages.projects') }}</span>
                                <i class="bi bi-arrow-right mobile-menu-arrow"></i>
                            </a>
                        </li>
                        <li class="mobile-menu-item">
                            <a href="{{url('/contact')}}" class="mobile-menu-link">
                                <i class="bi bi-envelope mobile-menu-icon"></i>
                                <span class="mobile-menu-text">{{ __('messages.contact') }}</span>
                                <i class="bi bi-arrow-right mobile-menu-arrow"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .brand-logo-link {
        text-decoration: none;
        position: relative;
        display: inline-block;
        transition: transform 0.3s ease;
    }
    
    .brand-logo-link:hover {
        transform: scale(1.05);
    }
    
    .brand-logo {
        font-size: 2.5rem;
        letter-spacing: 2px;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    body.darkmode .brand-logo {
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    @media (max-width: 991px) {
        .navbar-brand-left {
            display: none !important;
        }
        
        .brand-logo {
            font-size: 1.8rem;
        }
    }

.lang-flag-btn {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    background: #f8f9fa;
    border: 1.5px solid #adb5bd;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: box-shadow 0.2s;
}
.lang-flag-btn:hover, .lang-flag-btn:focus {
    box-shadow: 0 4px 16px rgba(95,46,234,0.10);
    background: #fff;
}
.lang-flag-img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #fff;
    object-fit: cover;
    border: 1px solid #dee2e6;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    display: block;
}

/* Mobile Navbar Improvements */
.mobile-brand-logo {
    text-decoration: none;
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: 1px;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-alt) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.mobile-brand-logo:hover {
    transform: scale(1.05);
    text-decoration: none;
}

.mobile-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.mobile-control-btn {
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    background: var(--color-card-bg);
    border: 1.5px solid rgba(95, 46, 234, 0.2);
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.2s ease;
}

.mobile-control-btn:hover, .mobile-control-btn:focus {
    box-shadow: 0 4px 16px rgba(95,46,234,0.15);
    background: var(--color-card-bg);
    border-color: var(--color-primary);
    transform: translateY(-1px);
}

.mobile-control-btn .lang-flag-img {
    width: 24px;
    height: 24px;
}

.mobile-toggle-btn {
    border: none;
    background: none;
    padding: 8px;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    width: 48px;
    height: 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 4px;
}

.mobile-toggle-btn:hover, .mobile-toggle-btn:focus {
    background: rgba(95, 46, 234, 0.1);
    box-shadow: 0 2px 12px rgba(95, 46, 234, 0.15);
}

.mobile-toggle-btn:focus {
    box-shadow: 0 0 0 3px rgba(95, 46, 234, 0.2);
}

.hamburger-line {
    width: 24px;
    height: 3px;
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-alt));
    border-radius: 2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

.mobile-toggle-btn[aria-expanded="true"] .hamburger-line:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

.mobile-toggle-btn[aria-expanded="true"] .hamburger-line:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

.mobile-toggle-btn[aria-expanded="true"] .hamburger-line:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}

/* Mobile Menu Improvements */
@media (max-width: 991px) {
    .custom-navbar {
        border-radius: 0;
        margin: 0;
        max-width: 100%;
        padding: 1rem 0;
        background: var(--color-navbar-bg) !important;
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(95, 46, 234, 0.1);
        position: relative;
        z-index: 1000;
    }
    
    .custom-navbar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
    }
    
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* Modern Mobile Menu Styling */
.mobile-menu-container {
    position: absolute;
    top: calc(100% + 8px);
    left: 1rem;
    right: 1rem;
    z-index: 9999;
    opacity: 0;
    transform: translateY(-20px) scale(0.95);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
}

.navbar-collapse.show .mobile-menu-container {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: all;
}

.mobile-menu-card {
    background: var(--color-card-bg);
    border-radius: 20px;
    box-shadow: 0 16px 48px rgba(95, 46, 234, 0.12);
    border: 1px solid rgba(95, 46, 234, 0.08);
    backdrop-filter: blur(20px);
    overflow: hidden;
    position: relative;
    margin: 0;
}

.mobile-menu-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--color-primary), var(--color-primary-alt), transparent);
    opacity: 0.6;
}

.mobile-menu-header {
    padding: 1.25rem 1.5rem 0.75rem 1.5rem;
    text-align: center;
    background: linear-gradient(135deg, rgba(95, 46, 234, 0.03), rgba(162, 89, 201, 0.03));
}

.mobile-menu-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--color-text);
    opacity: 0.8;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mobile-menu-divider {
    width: 32px;
    height: 2px;
    background: linear-gradient(90deg, var(--color-primary), var(--color-primary-alt));
    margin: 0.5rem auto 0 auto;
    border-radius: 1px;
    opacity: 0.8;
}

.mobile-menu-list {
    list-style: none;
    padding: 0.75rem 1rem 1.25rem 1rem;
    margin: 0;
}

.mobile-menu-item {
    margin-bottom: 0.375rem;
}

.mobile-menu-item:last-child {
    margin-bottom: 0;
}

.mobile-menu-link {
    display: flex;
    align-items: center;
    padding: 0.875rem 1rem;
    text-decoration: none;
    border-radius: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    background: rgba(95, 46, 234, 0.02);
    border: 1px solid rgba(95, 46, 234, 0.08);
    margin: 0;
}

.mobile-menu-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s;
}

.mobile-menu-link:hover::before {
    left: 100%;
}

.mobile-menu-link:hover {
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-alt));
    color: white !important;
    transform: translateX(6px);
    box-shadow: 0 6px 20px rgba(95, 46, 234, 0.25);
    border-color: transparent;
    text-decoration: none;
}

.mobile-menu-link:active {
    transform: translateX(3px) scale(0.98);
}

.mobile-menu-icon {
    font-size: 1.1rem;
    color: var(--color-primary);
    margin-right: 0.875rem;
    transition: all 0.3s ease;
    min-width: 18px;
    opacity: 0.8;
}

.mobile-menu-text {
    flex: 1;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--color-text);
    transition: color 0.3s ease;
}

.mobile-menu-arrow {
    font-size: 0.8rem;
    color: var(--color-text);
    opacity: 0.4;
    transition: all 0.3s ease;
}

.mobile-menu-link:hover .mobile-menu-icon {
    color: white;
    transform: scale(1.05);
    opacity: 1;
}

.mobile-menu-link:hover .mobile-menu-text {
    color: white;
}

.mobile-menu-link:hover .mobile-menu-arrow {
    color: white;
    opacity: 0.8;
    transform: translateX(3px);
}

/* Staggered animation for menu items */
.mobile-menu-item {
    opacity: 0;
    transform: translateY(10px);
    animation: slideInFromBottom 0.4s ease-out forwards;
}

.mobile-menu-item:nth-child(1) { animation-delay: 0.05s; }
.mobile-menu-item:nth-child(2) { animation-delay: 0.1s; }
.mobile-menu-item:nth-child(3) { animation-delay: 0.15s; }
.mobile-menu-item:nth-child(4) { animation-delay: 0.2s; }
.mobile-menu-item:nth-child(5) { animation-delay: 0.25s; }

@keyframes slideInFromBottom {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Dark mode adjustments for mobile menu */
body.darkmode .mobile-menu-card {
    background: var(--color-card-bg);
    border-color: rgba(162, 89, 201, 0.15);
    box-shadow: 0 16px 48px rgba(162, 89, 201, 0.12);
}

body.darkmode .mobile-menu-card::before {
    background: linear-gradient(90deg, transparent, var(--color-primary), var(--color-primary-alt), transparent);
}

body.darkmode .mobile-menu-header {
    background: linear-gradient(135deg, rgba(162, 89, 201, 0.03), rgba(95, 46, 234, 0.03));
}

body.darkmode .mobile-menu-divider {
    background: linear-gradient(90deg, var(--color-primary), var(--color-primary-alt));
}

body.darkmode .mobile-menu-link {
    background: rgba(162, 89, 201, 0.02);
    border-color: rgba(162, 89, 201, 0.08);
}

body.darkmode .mobile-menu-link:hover {
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-alt));
    box-shadow: 0 6px 20px rgba(162, 89, 201, 0.25);
}

/* Dark mode adjustments for mobile controls */
body.darkmode .mobile-control-btn {
    background: var(--color-card-bg);
    border-color: rgba(162, 89, 201, 0.3);
}

body.darkmode .mobile-control-btn:hover, body.darkmode .mobile-control-btn:focus {
    border-color: var(--color-primary);
    box-shadow: 0 4px 16px rgba(162, 89, 201, 0.15);
}

body.darkmode .mobile-toggle-btn:hover, body.darkmode .mobile-toggle-btn:focus {
    background: rgba(162, 89, 201, 0.1);
    box-shadow: 0 2px 12px rgba(162, 89, 201, 0.15);
}

body.darkmode .mobile-toggle-btn:focus {
    box-shadow: 0 0 0 3px rgba(162, 89, 201, 0.2);
}

body.darkmode .hamburger-line {
    background: linear-gradient(135deg, var(--color-primary), var(--color-primary-alt));
}
</style>

<script>
    // Theme toggle logic
    function setTheme(mode) {
        if(mode === 'dark') {
            document.body.classList.add('darkmode');
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            document.getElementById('theme-icon').className = 'bi bi-sun';
            document.getElementById('theme-icon-mobile').className = 'bi bi-sun';
        } else {
            document.body.classList.remove('darkmode');
            document.documentElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('theme', 'light');
            document.getElementById('theme-icon').className = 'bi bi-moon';
            document.getElementById('theme-icon-mobile').className = 'bi bi-moon';
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const saved = localStorage.getItem('theme');
        
        // Als er geen opgeslagen thema is, controleer systeemvoorkeur
        if (!saved) {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            setTheme(prefersDark ? 'dark' : 'light');
        } else {
            setTheme(saved === 'dark' ? 'dark' : 'light');
        }
        
        document.getElementById('theme-toggle').onclick = function() {
            setTheme(document.body.classList.contains('darkmode') ? 'light' : 'dark');
        };
        
        // Mobile theme toggle
        document.getElementById('theme-toggle-mobile').onclick = function() {
            setTheme(document.body.classList.contains('darkmode') ? 'light' : 'dark');
        };

        // Bootstrap tooltip initialisatie
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
