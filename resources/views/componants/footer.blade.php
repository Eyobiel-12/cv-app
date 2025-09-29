<!-- Footer Modern -->
<footer class="footer-modern py-5 mt-auto">
    <div class="container text-center">
        <div class="footer-social mb-4">
            <a href="https://nl.linkedin.com/in/serhat-yildirim-15a6a4199" class="footer-icon mx-3" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
            <a href="https://gitlab.com/serhatcanyildirimm" class="footer-icon mx-3" aria-label="GitLab" target="_blank" rel="noopener noreferrer">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.6004 9.5927l-.0337-.0862L20.3.9814a.851.851 0 00-.3362-.405.8748.8748 0 00-.9997.0539.8748.8748 0 00-.29.4399l-2.2055 6.748H7.5375l-2.2057-6.748a.8573.8573 0 00-.29-.4412.8748.8748 0 00-.9997-.0537.8585.8585 0 00-.3362.4049L.4332 9.5015l-.0325.0862a6.0657 6.0657 0 002.0119 7.0105l.0113.0087.03.0213 4.976 3.7264 2.462 1.8633 1.4995 1.1321a1.0085 1.0085 0 001.2197 0l1.4995-1.1321 2.4619-1.8633 5.006-3.7466.0125-.01a6.0682 6.0682 0 002.0094-7.003z"/>
                </svg>
            </a>
            <a href="mailto:serhatcanyildirimm@gmail.com" class="footer-icon mx-3" aria-label="E-mail"><i class="bi bi-envelope"></i></a>
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
