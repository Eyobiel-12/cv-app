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
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/resume')}}">CV</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/services')}}">Services</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/work')}}">Work</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/projects')}}">Projects</a></li>
                <li class="nav-item"><a class="nav-link nav-link-modern px-4 py-2" href="{{url('/contact')}}">Contact</a></li>
                
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
    });
</script>
