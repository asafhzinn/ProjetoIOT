<div>
    <x-navbar />

    <div class="container py-4">
        <h1 class="h3 mb-4"><i class="bi bi-shield-check me-2"></i>Ambientes</h1>

        <x-alertas />

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-semibold">
                        {{ $ambienteId ? 'Editar ambiente' : 'Novo ambiente' }}
                    </div>
                    <div class="card-body">
                        <form wire:submit="salvar">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" id="nome" wire:model="nome" @class(['form-control', 'is-invalid' => $errors->has('nome')])>
                                @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea id="descricao" rows="3" wire:model="descricao" @class(['form-control', 'is-invalid' => $errors->has('descricao')])></textarea>
                                @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="status" wire:model="status">
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i>{{ $ambienteId ? 'Atualizar' : 'Cadastrar' }}
                                </button>
                                @if ($ambienteId)
                                    <button type="button" class="btn btn-outline-secondary" wire:click="cancelar">Cancelar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
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
                                            <button class="btn btn-sm btn-outline-primary" wire:click="editar({{ $ambiente->id }})" title="Editar">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" wire:click="excluir({{ $ambiente->id }})" wire:confirm="Deseja realmente excluir este ambiente?" title="Excluir">
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
    </div>
</div>
