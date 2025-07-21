@extends('dashboard.layout')
@section('dashboard-content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bolder">CV Download Statistieken</h1>
        </div>

        <!-- Statistieken overzicht -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">Totaal Downloads</h5>
                            <i class="bi bi-download text-primary fs-3"></i>
                        </div>
                        <h2 class="text-primary">{{ $totalDownloads ?? 0 }}</h2>
                        <p class="text-muted mb-0">Alle downloads sinds het begin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">Beveiligde Downloads</h5>
                            <i class="bi bi-shield-lock text-primary fs-3"></i>
                        </div>
                        <h2 class="text-primary">{{ $protectedDownloads ?? 0 }}</h2>
                        <p class="text-muted mb-0">Downloads met wachtwoord verificatie</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow border-0 rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">Conversie Ratio</h5>
                            <i class="bi bi-percent text-primary fs-3"></i>
                        </div>
                        <h2 class="text-primary">
                            @if(isset($totalDownloads) && $totalDownloads > 0 && isset($protectedDownloads))
                                {{ round(($protectedDownloads / $totalDownloads) * 100) }}%
                            @else
                                0%
                            @endif
                        </h2>
                        <p class="text-muted mb-0">Beveiligd vs. totaal downloads</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Downloads grafiek -->
        <div class="card shadow border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bolder mb-0">
                        <i class="bi bi-graph-up me-2"></i>Downloads per Dag
                    </h3>
                    <div class="text-muted">
                        Laatste 30 dagen
                    </div>
                </div>
                
                @if(isset($downloadsPerDay) && count($downloadsPerDay) > 0)
                    <div class="chart-container" style="position: relative; height:300px; width:100%">
                        <canvas id="downloadsChart"></canvas>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Geen download data beschikbaar voor de laatste 30 dagen
                    </div>
                @endif
            </div>
        </div>

        <!-- Recente downloads -->
        <div class="card shadow border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bolder mb-0">
                        <i class="bi bi-clock-history me-2"></i>Recente Downloads
                    </h3>
                </div>
                
                @if(isset($recentDownloads) && count($recentDownloads) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Adres</th>
                                    <th>User Agent</th>
                                    <th>Type</th>
                                    <th>Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentDownloads as $download)
                                    <tr>
                                        <td>{{ $download->id }}</td>
                                        <td>{{ $download->ip_address }}</td>
                                        <td>
                                            <span class="d-inline-block text-truncate" style="max-width: 300px;" title="{{ $download->user_agent }}">
                                                {{ $download->user_agent }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($download->is_protected_download)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-shield-lock me-1"></i>Beveiligd
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-unlock me-1"></i>Normaal
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($download->created_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Geen recente downloads gevonden
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('dashboard-scripts')
<!-- Chart.js voor de grafiek -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Controleer of er download data is en of het canvas element bestaat
        const chartCanvas = document.getElementById('downloadsChart');
        if (!chartCanvas) return;
        
        // Haal de data uit de PHP variabele
        const downloadsPerDay = @json($downloadsPerDay ?? []);
        if (!downloadsPerDay || downloadsPerDay.length === 0) return;
        
        // Bereid de data voor
        const labels = [];
        const data = [];
        
        downloadsPerDay.forEach(item => {
            // Formatteer de datum voor weergave
            const date = new Date(item.date);
            const formattedDate = date.toLocaleDateString('nl-NL', {
                day: '2-digit',
                month: '2-digit'
            });
            
            labels.push(formattedDate);
            data.push(item.count);
        });
        
        // Maak de grafiek
        const ctx = chartCanvas.getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Downloads',
                    data: data,
                    backgroundColor: 'rgba(var(--color-primary-rgb), 0.7)',
                    borderColor: 'rgba(var(--color-primary-rgb), 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    maxBarThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                return 'Datum: ' + tooltipItems[0].label;
                            },
                            label: function(context) {
                                return 'Downloads: ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection 