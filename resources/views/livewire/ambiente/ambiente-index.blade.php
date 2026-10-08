<div>
    <x-navbar />

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><i class="bi bi-shield-check me-2"></i>Ambientes</h1>
            <a href="{{ route('ambientes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>Novo ambiente
            </a>
        </div>

        <x-alertas />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center gap-2">
                <span class="fw-semibold">Lista de ambientes</span>
                <input type="search" class="form-control form-control-sm w-auto" placeholder="Buscar por nome..." wire:model.live.debounce.300ms="busca">
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Sensores</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ambientes as $ambiente)
                            <tr wire:key="ambiente-{{ $ambiente->id }}">
                                <td>{{ $ambiente->id }}</td>
                                <td>{{ $ambiente->nome }}</td>
                                <td class="text-body-secondary">{{ $ambiente->descricao }}</td>
                                <td>{{ $ambiente->sensores_count }}</td>
                                <td>
                                    @if ($ambiente->status)
                                        <span class="badge bg-success">Ativo</span>
                                    @else
                                        <span class="badge bg-secondary">Inativo</span>
                                    @endif
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('ambientes.edit', $ambiente) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" wire:click="excluir({{ $ambiente->id }})" wire:confirm="Deseja realmente excluir este ambiente?">
                                        <i class="bi bi-trash"></i> Excluir
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-body-secondary py-4">Nenhum ambiente cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($ambientes->hasPages())
                <div class="card-footer">{{ $ambientes->links() }}</div>
            @endif
        </div>
    </div>
</div>
