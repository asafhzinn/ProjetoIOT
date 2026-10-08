<div>
    <x-navbar />

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><i class="bi bi-cpu me-2"></i>Sensores</h1>
            <a href="{{ route('sensores.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Novo sensor
            </a>
        </div>

        <x-alertas />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-2">
                <span class="fw-semibold">Lista de sensores</span>
                <input type="search" class="form-control form-control-sm w-auto" placeholder="Buscar código/tipo..." wire:model.live.debounce.300ms="busca">
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Ambiente</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sensores as $sensor)
                            <tr wire:key="sensor-{{ $sensor->id }}">
                                <td>{{ $sensor->id }}</td>
                                <td class="fw-semibold">{{ $sensor->codigo }}</td>
                                <td>{{ $sensor->tipo }}</td>
                                <td>{{ $sensor->ambiente?->nome }}</td>
                                <td class="text-body-secondary">{{ $sensor->descricao }}</td>
                                <td>
                                    @if ($sensor->status)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-secondary">Inativo</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('sensores.edit', $sensor) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="excluir({{ $sensor->id }})" wire:confirm="Deseja realmente excluir este sensor?">
                                        <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-body-secondary py-4">Nenhum sensor cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($sensores->hasPages())
                <div class="card-footer">{{ $sensores->links() }}</div>
            @endif
        </div>
    </div>
</div>
