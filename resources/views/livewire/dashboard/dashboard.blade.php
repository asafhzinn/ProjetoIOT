<div class="container-fluid py-4 bg-light min-vh-100">

    <div class="row align-items-center mb-4 g-3">

        <div class="col-12 col-md-6">
            <h1 class="h3 mb-1 fw-bold text-dark">Painel de Controle IoT</h1>
            <p class="text-muted small mb-0">Monitore as leituras de sensores e status dos ambientes em tempo real.</p>
        </div>

    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 mb-4">
        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-muted fw-bold tracking-wider"
                            style="font-size: 0.7rem;">Ambientes</span>
                        <h3 class="h2 mb-0 fw-bold text-dark mt-1">{{ count($ambientes ?? []) }}</h3>
                    </div>
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px;">
                        <i class="fs-4 bi bi-house-door"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-muted fw-bold tracking-wider"
                            style="font-size: 0.7rem;">Sensores Ativos</span>
                        <h3 class="h2 mb-0 fw-bold text-dark mt-1">{{ $totalSensores ?? 0 }}</h3>
                    </div>
                    <div class="rounded-3 bg-success bg-opacity-10 text-success p-2 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px;">
                        <i class="fs-4 bi bi-cpu"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.7rem;">Última
                            Temperatura</span>
                        <h3 class="h2 mb-0 fw-bold text-dark mt-1">{{ $ultimaTemperatura ?? '0' }}°C</h3>
                    </div>
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-2 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px;">
                        <i class="fs-4 bi bi-thermometer-half"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.7rem;">Total
                            de Leituras</span>
                        <h3 class="h2 mb-0 fw-bold text-dark mt-1">{{ $totalRegistros ?? 0 }}</h3>
                    </div>
                    <div class="rounded-3 bg-purple bg-opacity-10 p-2 d-flex align-items-center justify-content-center"
                        style="width: 45px; height: 45px; background-color: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                        <i class="fs-4 bi bi-database-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom-0">
            <h5 class="card-title mb-0 fw-bold text-dark">Histórico Recente de Leituras</h5>
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-semibold"
                style="font-size: 0.75rem;">
                Tempo Real
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase fs-7 text-secondary">
                    <tr>
                        <th scope="col" class="ps-4" style="font-size: 0.75rem;">ID</th>
                        <th scope="col" style="font-size: 0.75rem;">Ambiente</th>
                        <th scope="col" style="font-size: 0.75rem;">Sensor</th>
                        <th scope="col" style="font-size: 0.75rem;">Valor Capturado</th>
                        <th scope="col" class="pe-4" style="font-size: 0.75rem;">Data / Hora</th>
                    </tr>
                </thead>
                <tbody class="text-secondary" style="font-size: 0.9rem;">
                    @forelse($registros ?? [] as $registro)
                        <tr>
                            <td class="ps-4 fw-bold text-dark">#{{ $registro->id }}</td>
                            <td>{{ $registro->sensor->ambiente->nome ?? 'Não informado' }}</td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                    {{ $registro->sensor->nome ?? 'Desconhecido' }}
                                </span>
                            </td>
                            <td class="fw-bold text-primary">{{ $registro->valor }}</td>
                            <td class="pe-4 text-muted">
                                {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Nenhuma leitura de sensor encontrada para os filtros selecionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($registros, 'links'))
            <div class="card-footer bg-light border-top-0 px-4 py-3">
                {{ $registros->links() }}
            </div>
        @endif
    </div>
</div>