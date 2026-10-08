<div wire:poll.3s="atualizarDados" data-bs-theme="dark" class="bg-dark text-light min-vh-100">
    <!-- Navbar Única do Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-secondary-subtle px-3 mb-4">
        <div class="container-fluid">
            <!-- Título / Logotipo -->
            <a class="navbar-brand fw-bold text-primary" href="#">
                Dashboard IoT
            </a>

            <!-- Menu de Navegação -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ambientes.index') }}">
                            <i class="bi bi-shield-check me-1"></i> Ambientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sensores.index') }}">
                            <i class="bi bi-cpu me-1"></i> Sensores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-list-ul me-1"></i> Registros
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Indicador Visual Lateral -->
            <div class="d-flex align-items-center ms-auto">
                <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill small">
                    <span class="spinner-grow spinner-grow-sm text-success" role="status"></span> Online
                </span>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal do Dashboard -->
    <div class="container-fluid px-4">
        
        <!-- GRID DE CARDS DE STATUS -->
        <div class="row g-3 mb-4">
            <!-- Card Última Leitura (Substitui Temperatura isolada) -->
            <div class="col-12 col-md-4">
                <div class="card bg-body-tertiary border-secondary-subtle h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle text-body-secondary fw-semibold text-uppercase small">Último Valor</h6>
                            <span class="fs-4">📊</span>
                        </div>
                        <!-- Pega o valor do registro mais recente da lista se houver -->
                        <h2 class="card-title display-6 fw-bold text-warning my-2">
                            {{ !empty($registros) ? $registros[0]['valor'] : '—' }}
                        </h2>
                        <small class="text-success small">● {{ $statusAmbiente }}</small>
                    </div>
                </div>
            </div>

            <!-- Card Status do Sistema -->
            <div class="col-12 col-md-4">
                <div class="card bg-body-tertiary border-secondary-subtle h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle text-body-secondary fw-semibold text-uppercase small">Status de Sincronia</h6>
                            <span class="fs-4">🔄</span>
                        </div>
                        <h2 class="card-title fs-3 fw-bold text-primary my-2 text-truncate">
                            {{ $statusAmbiente }}
                        </h2>
                        <small class="text-body-secondary small">Atualizando via Polling</small>
                    </div>
                </div>
            </div>

            <!-- Card Dispositivos (Total de Sensores) -->
            <div class="col-12 col-md-4">
                <div class="card bg-body-tertiary border-secondary-subtle h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle text-body-secondary fw-semibold text-uppercase small">Sensores Ativos</h6>
                            <span class="fs-4">🤖</span>
                        </div>
                        <h2 class="card-title display-6 fw-bold text-info my-2">{{ $totalSensores }}</h2>
                        <small class="text-body-secondary small">Cadastrados no sistema</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- COLUNA DO GRÁFICO (Removido os scripts quebrados que dependiam de variáveis inexistentes) -->
            <div class="col-12 col-lg-7">
                <div class="card bg-body-tertiary border-secondary-subtle shadow-sm p-3 h-100">
                    <h5 class="card-title mb-3 fw-semibold text-body-emphasis">Histórico do Ambiente</h5>
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 text-muted border border-dashed rounded py-5">
                        <i class="bi bi-graph-up fs-1 mb-2"></i>
                        <span class="small">Acompanhe os detalhes na tabela ao lado</span>
                    </div>
                </div>
            </div>

            <!-- COLUNA DA LISTAGEM RECENTE -->
            <div class="col-12 col-lg-5">
                <div class="card bg-body-tertiary border-secondary-subtle shadow-sm p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0 fw-semibold text-body-emphasis">Registros Recentes</h5>
                        <span class="badge bg-secondary-subtle text-secondary-heading small">Últimas leituras</span>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-striped align-middle mb-0 small">
                            <thead>
                                <tr class="text-secondary border-secondary">
                                    <th scope="col">Dispositivo</th>
                                    <th scope="col">Leitura Realizada</th>
                                    <th scope="col">Horário</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(array_slice($registros, 0, 5) as $registro)
                                    <tr>
                                        <td>
                                            <span class="text-info fw-medium">{{ $registro['sensor'] }}</span>
                                        </td>
                                        <td class="text-warning fw-bold">
                                            {{ $registro['valor'] }}
                                        </td>
                                        <td class="text-muted">
                                            {{ date('H:i:s', strtotime(str_replace('/', '-', $registro['horario']))) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-3">
                                            Nenhum registro recebido ainda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
