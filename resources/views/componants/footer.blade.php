<!-- Footer Modern -->
<footer class="footer-modern py-5 mt-auto">
    <div class="container text-center">
        <div class="footer-social mb-4">
            <a href="#" class="footer-icon mx-3" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="footer-icon mx-3" aria-label="GitHub"><i class="bi bi-github"></i></a>
            <a href="#" class="footer-icon mx-3" aria-label="E-mail"><i class="bi bi-envelope"></i></a>
        </div>
        <div class="footer-divider mx-auto mb-4"></div>
        <div class="footer-copyright small">
            &copy; {{ date('Y') }} <span class="fw-bold">Serhat Yildirim</span> &mdash; All rights reserved.
        </div>
    </div>
</footer>

<style>
    .footer-modern {
        background: transparent;
        color: var(--color-text);
        margin-bottom: 0;
        padding-bottom: 32px;
        padding-top: 32px;
        position: relative;
    }
    
    .footer-social {
        display: flex;
        justify-content: center;
        gap: 32px;
    }
    
    .footer-icon {
        font-size: 1.8rem;
        color: #fff;
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-alt));
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(var(--color-primary-rgb, 95, 46, 234), 0.15);
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    }
    
    .footer-icon:hover {
        transform: translateY(-4px) scale(1.12);
        box-shadow: 0 6px 24px rgba(var(--color-primary-rgb, 95, 46, 234), 0.25);
        background: linear-gradient(135deg, var(--color-primary-alt), var(--color-primary));
        color: #fff;
        text-decoration: none;
    }
    
    .footer-divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-primary-alt));
        border-radius: 2px;
        opacity: 0.25;
    }
    
    .footer-copyright {
        color: var(--color-text);
        opacity: 0.85;
    }
    
    @media (max-width: 600px) {
        .footer-social {
            gap: 16px;
        }
        
        .footer-icon {
            font-size: 1.3rem;
            width: 36px;
            height: 36px;
        }
        
        .footer-divider {
            width: 40px;
            height: 2px;
        }
    }
</style>
