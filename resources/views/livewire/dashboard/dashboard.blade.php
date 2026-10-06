<div wire:poll.3s="atualizarDados" data-bs-theme="dark">
    <!-- Navbar Única do Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-secondary-subtle px-3">
        <div class="container-fluid">
            <!-- Título / Logotipo -->
            <a class="navbar-brand fw-bold text-primary" href="#">
                Dashboard IoT
            </a>

            <!-- Menu de Navegação -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-shield-check me-1"></i> Ambiente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
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
</div>
