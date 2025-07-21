<!-- Navigation Ultra Modern -->
<div class="navbar-brand-left position-absolute top-0 start-0 ps-5 pt-4" style="z-index:10;">
    <a href="{{url('/')}}" class="brand-logo-link">
        <span class="brand-logo fw-bold text-uppercase">SERHAT.</span>
    </a>
</div>
<nav class="navbar navbar-expand-lg custom-navbar shadow-lg py-3 justify-content-center">
    <div class="container px-4 justify-content-center">
        <!-- Geen navbar-brand meer hier -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 gap-2 align-items-center">
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/')}}">{{ __('messages.home') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/resume')}}">{{ __('messages.cv') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/services')}}">{{ __('messages.services') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/work')}}">{{ __('messages.work') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/projects')}}">{{ __('messages.projects') }}</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/contact')}}">{{ __('messages.contact') }}</a></li>
                
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
            padding-left: 1rem !important;
            padding-top: 1rem !important;
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
</style>

<script>
    // Theme toggle logic
    function setTheme(mode) {
        if(mode === 'dark') {
            document.body.classList.add('darkmode');
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            document.getElementById('theme-icon').className = 'bi bi-sun';
        } else {
            document.body.classList.remove('darkmode');
            document.documentElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('theme', 'light');
            document.getElementById('theme-icon').className = 'bi bi-moon';
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

        // Bootstrap tooltip initialisatie
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
