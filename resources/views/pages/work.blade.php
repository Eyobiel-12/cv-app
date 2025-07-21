@extends('app')
@section('content')

<!-- Projects Section-->
<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Mijn Werk</span></h1>
        </div>
        
        <div class="row">
            @if(count($projects) > 0)
                @foreach($projects as $project)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 project-card" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                            <div class="position-relative">
                                @if(!empty($project->thumbLink))
                                    <img class="card-img-top" src="{{ asset('storage/' . $project->thumbLink) }}" alt="{{ $project->title }}" style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                        <span class="text-muted">Geen afbeelding</span>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 p-2">
                                    @if(!empty($project->previewLink))
                                        <a href="{{ $project->previewLink }}" target="_blank" class="btn btn-sm btn-light rounded-circle shadow-sm" title="Bekijk live project" onclick="event.stopPropagation();">
                                            <i class="bi bi-link-45deg"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2">{{ $project->title }}</h5>
                                @if(isset($project->languages) && count($project->languages) > 0)
                                    <div class="mb-3">
                                        @foreach($project->languages->take(3) as $language)
                                            <span class="badge me-1 mb-1" style="background-color: {{ $language->color_code ?? '#6c757d' }}; font-size: 0.75rem; padding: 0.25em 0.5em;">
                                                @if(!empty($language->icon))
                                                    <i class="{{ $language->icon }} me-1"></i>
                                                @endif
                                                {{ $language->name }}
                                            </span>
                                        @endforeach
                                        @if(count($project->languages) > 3)
                                            <span class="badge bg-secondary me-1 mb-1" style="font-size: 0.75rem; padding: 0.25em 0.5em;">
                                                +{{ count($project->languages) - 3 }} meer
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <p class="card-text text-muted small mb-3">{{ \Illuminate\Support\Str::limit($project->details, 100) }}</p>
                                <button class="btn btn-primary btn-sm" onclick="event.stopPropagation();" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                                    <i class="bi bi-eye me-1"></i>Details bekijken
                                </button>
                            </div>
                        </div>
                        
                        <!-- Project Modal -->
                        <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bolder">{{ $project->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-4 mb-md-0">
                                                @if(!empty($project->thumbLink))
                                                    <img src="{{ asset('storage/' . $project->thumbLink) }}" alt="{{ $project->title }}" class="img-fluid rounded-3">
                                                @else
                                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 250px;">
                                                        <span class="text-muted">Geen afbeelding</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if(isset($project->languages) && count($project->languages) > 0)
                                                    <div class="mb-3">
                                                        @foreach($project->languages as $language)
                                                            <span class="badge me-1 mb-1" style="background-color: {{ $language->color_code ?? '#6c757d' }}; font-size: 0.85rem; padding: 0.35em 0.65em;">
                                                                @if(!empty($language->icon))
                                                                    <i class="{{ $language->icon }} me-1"></i>
                                                                @endif
                                                                {{ $language->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="mb-4">
                                                    <p>{{ $project->details }}</p>
                                                </div>
                                                @if(!empty($project->previewLink))
                                                    <a href="{{ $project->previewLink }}" target="_blank" class="btn btn-primary">
                                                        <i class="bi bi-link-45deg me-1"></i>Bekijk Project
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>Geen projecten gevonden
                    </div>
                </div>
            @endif
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ url('/projects') }}" class="btn btn-outline-primary">
                <i class="bi bi-grid-3x3-gap me-1"></i>Bekijk alle projecten
            </a>
        </div>
    </div>
</section>

@include('componants.call-action')
@endsection 