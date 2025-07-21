@extends('app')
@section('content')
    <div class="container py-5">
        <div class="resume-header text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">{{ __('messages.cv') }}</h1>
            @include('componants.experience')
         </div>
@endsection

<style>
    .resume-header {
        position: relative;
    }
    
    .resume-subtitle {
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }
    
    .resume-divider {
        height: 4px;
        width: 80px;
        background: linear-gradient(90deg, var(--color-primary), var(--color-primary-alt));
        border-radius: 2px;
    }
    
    /* Animaties voor page load */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .resume-header {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
