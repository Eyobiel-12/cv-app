@extends('dashboard.layout')
@section('dashboard-content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bolder">Projecten Beheer</h1>
        </div>

        <div class="row">
            <!-- Projecten beheer -->
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-4 mb-5">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bolder mb-0">
                                <i class="bi bi-kanban me-2"></i>Projecten
                            </h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProjectModal">
                                <i class="bi bi-plus-lg me-1"></i>Nieuw Project
                            </button>
                        </div>
                        
                        @if(isset($projects) && count($projects) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Afbeelding</th>
                                            <th>Titel</th>
                                            <th>Programmeertalen</th>
                                            <th>Preview Link</th>
                                            <th>Acties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                            <tr>
                                                <td>{{ $project->id }}</td>
                                                <td>
                                                    @if(!empty($project->thumbLink))
                                                        <img src="{{ asset('storage/' . $project->thumbLink) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-width: 60px;">
                                                    @else
                                                        <span class="badge bg-secondary">Geen afbeelding</span>
                                                    @endif
                                                </td>
                                                <td>{{ $project->title }}</td>
                                                <td>
                                                    @if(isset($project->languages) && count($project->languages) > 0)
                                                        @foreach($project->languages as $language)
                                                            <span class="badge" style="background-color: {{ $language->color_code ?? '#6c757d' }}">
                                                                @if(!empty($language->icon))
                                                                    <i class="{{ $language->icon }}"></i>
                                                                @endif
                                                                {{ $language->name }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="badge bg-secondary">Geen talen</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($project->previewLink))
                                                        <a href="{{ $project->previewLink }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-link-45deg"></i>
                                                        </a>
                                                    @else
                                                        <span class="badge bg-secondary">Geen link</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary me-1" data-bs-toggle="modal" data-bs-target="#editProjectModal{{ $project->id }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form method="POST" action="{{ route('dashboard.projects.delete', $project->id) }}" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    
                                                    <!-- Edit Project Modal -->
                                                    <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" aria-labelledby="editProjectModalLabel{{ $project->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editProjectModalLabel{{ $project->id }}">
                                                                        Project Bewerken
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="POST" action="{{ route('dashboard.projects.update', $project->id) }}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="title{{ $project->id }}" class="form-label">Titel</label>
                                                                            <input type="text" class="form-control" id="title{{ $project->id }}" name="title" value="{{ $project->title }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="details{{ $project->id }}" class="form-label">Details</label>
                                                                            <textarea class="form-control" id="details{{ $project->id }}" name="details" rows="4" required>{{ $project->details }}</textarea>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="previewLink{{ $project->id }}" class="form-label">Preview Link</label>
                                                                            <input type="url" class="form-control" id="previewLink{{ $project->id }}" name="previewLink" value="{{ $project->previewLink }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="thumbnail{{ $project->id }}" class="form-label">Thumbnail</label>
                                                                            <div class="input-group">
                                                                                <input type="file" class="form-control" id="thumbnail{{ $project->id }}" name="thumbnail" accept="image/*">
                                                                            </div>
                                                                            @if(!empty($project->thumbLink))
                                                                                <div class="mt-2">
                                                                                    <img src="{{ asset('storage/' . $project->thumbLink) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-width: 100px;">
                                                                                    <div class="form-text">Huidige afbeelding. Upload een nieuwe om deze te vervangen.</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Programmeertalen</label>
                                                                            <div class="row">
                                                                                @foreach($programmingLanguages as $language)
                                                                                    <div class="col-md-4 mb-2">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="programming_languages[]" value="{{ $language->id }}" id="lang{{ $project->id }}_{{ $language->id }}"
                                                                                                @if(isset($project->languages))
                                                                                                    @foreach($project->languages as $projectLanguage)
                                                                                                        @if($projectLanguage->id == $language->id) checked @endif
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            >
                                                                                            <label class="form-check-label" for="lang{{ $project->id }}_{{ $language->id }}">
                                                                                                <span class="badge" style="background-color: {{ $language->color_code ?? '#6c757d' }}">
                                                                                                    @if(!empty($language->icon))
                                                                                                        <i class="{{ $language->icon }}"></i>
                                                                                                    @endif
                                                                                                    {{ $language->name }}
                                                                                                </span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                                                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>Geen projecten gevonden
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Programmeertalen beheer -->
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 mb-5">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bolder mb-0">
                                <i class="bi bi-code-slash me-2"></i>Programmeertalen
                            </h3>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLanguageModal">
                                <i class="bi bi-plus-lg me-1"></i>Nieuwe Taal
                            </button>
                        </div>
                        
                        @if(isset($programmingLanguages) && count($programmingLanguages) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Naam</th>
                                            <th>Kleur</th>
                                            <th>Acties</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($programmingLanguages as $language)
                                            <tr>
                                                <td>
                                                    @if(!empty($language->icon))
                                                        <i class="{{ $language->icon }}"></i>
                                                    @endif
                                                    {{ $language->name }}
                                                </td>
                                                <td>
                                                    <span class="badge" style="background-color: {{ $language->color_code ?? '#6c757d' }}">
                                                        {{ $language->color_code ?? 'Geen kleur' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('dashboard.programming-languages.delete', $language->id) }}" onsubmit="return confirm('Weet je zeker dat je deze programmeertaal wilt verwijderen?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>Geen programmeertalen gevonden
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Project Modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProjectModalLabel">
                    Nieuw Project Toevoegen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('dashboard.projects.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea class="form-control" id="details" name="details" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="previewLink" class="form-label">Preview Link</label>
                        <input type="url" class="form-control" id="previewLink" name="previewLink">
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Programmeertalen</label>
                        <div class="row">
                            @foreach($programmingLanguages as $language)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="programming_languages[]" value="{{ $language->id }}" id="lang_{{ $language->id }}">
                                        <label class="form-check-label" for="lang_{{ $language->id }}">
                                            <span class="badge" style="background-color: {{ $language->color_code ?? '#6c757d' }}">
                                                @if(!empty($language->icon))
                                                    <i class="{{ $language->icon }}"></i>
                                                @endif
                                                {{ $language->name }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Language Modal -->
<div class="modal fade" id="createLanguageModal" tabindex="-1" aria-labelledby="createLanguageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLanguageModalLabel">
                    Nieuwe Programmeertaal Toevoegen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('dashboard.programming-languages.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Naam</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="color_code" class="form-label">Kleurcode</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="color_picker" value="#6c757d">
                            <input type="text" class="form-control" id="color_code" name="color_code" placeholder="#6c757d">
                        </div>
                        <div class="form-text">Kies een kleur of voer een HEX kleurcode in (bijv. #FF5733)</div>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon (Bootstrap Icons class)</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="bi bi-code-slash">
                        <div class="form-text">
                            Voer een Bootstrap Icons class in. 
                            <a href="https://icons.getbootstrap.com/" target="_blank">Bekijk alle beschikbare icons</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('dashboard-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kleurpicker voor nieuwe programmeertaal
        const colorPicker = document.getElementById('color_picker');
        const colorCodeInput = document.getElementById('color_code');
        
        if (colorPicker && colorCodeInput) {
            // Sync kleurpicker met input veld
            colorPicker.addEventListener('input', function() {
                colorCodeInput.value = this.value;
            });
            
            // Sync input veld met kleurpicker
            colorCodeInput.addEventListener('input', function() {
                if (this.value.startsWith('#') && (this.value.length === 4 || this.value.length === 7)) {
                    colorPicker.value = this.value;
                }
            });
        }
    });
</script>
@endsection 