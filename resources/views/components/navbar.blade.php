<nav {{ $attributes->merge(['class' => 'navbar navbar-expand-lg bg-body-tertiary border-bottom border-secondary-subtle px-3']) }}>
    {{-- <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="{{ url('/dashboard') }}">
            Dashboard IoT
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->is('ambientes*')]) href="{{ route('ambientes.index') }}">
                        <i class="bi bi-shield-check me-1"></i> Ambiente
                    </a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->is('sensores*')]) href="{{ route('sensores.index') }}">
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

        
    </div> --}}
    {{ $slot }}
</nav>
