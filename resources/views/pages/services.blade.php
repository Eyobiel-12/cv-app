@extends('app')
@section('content')
    <div class="container py-5">
        <h1 class="display-4 fw-bold text-center mb-5">{{ __('messages.services') }}</h1>
        @include('componants.services')
    </div>
@endsection 