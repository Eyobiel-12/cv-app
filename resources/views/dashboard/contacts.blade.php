@extends('dashboard.layout')
@section('dashboard-content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bolder">Contactberichten</h1>
        </div>

        <div class="card shadow border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bolder mb-0">
                        <i class="bi bi-envelope-fill me-2"></i>Alle Berichten
                    </h3>
                    <div class="text-muted">
                        Totaal: {{ $contacts->total() }} berichten
                    </div>
                </div>
                
                @if(count($contacts) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naam</th>
                                    <th>Email</th>
                                    <th>Onderwerp</th>
                                    <th>Bericht</th>
                                    <th>Datum</th>
                                    <th>Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->fullName }}</td>
                                        <td>
                                            <a href="mailto:{{ $contact->email }}">
                                                {{ $contact->email }}
                                            </a>
                                        </td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-link p-0" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                                {{ \Illuminate\Support\Str::limit($contact->message, 30) }}
                                            </button>
                                            
                                            <!-- Message Modal -->
                                            <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $contact->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="messageModalLabel{{ $contact->id }}">
                                                                Bericht van {{ $contact->fullName }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong>Onderwerp:</strong> {{ $contact->subject }}
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Email:</strong> 
                                                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>Datum:</strong> 
                                                                {{ \Carbon\Carbon::parse($contact->created_at)->format('d-m-Y H:i') }}
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    {{ $contact->message }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary">
                                                                <i class="bi bi-reply me-1"></i>Beantwoorden
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($contact->created_at)->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-sm btn-outline-primary me-1" title="Beantwoorden">
                                                    <i class="bi bi-reply"></i>
                                                </a>
                                                <form method="POST" action="{{ route('dashboard.contacts.delete', $contact->id) }}" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Verwijderen">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $contacts->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Geen berichten gevonden
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 