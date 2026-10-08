<div>
    <x-navbar />

    <div class="container py-4">
        <h1 class="h3 mb-4"><i class="bi bi-cpu me-2"></i>Sensores</h1>

        <x-alertas />

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-semibold">
                        {{ $sensorId ? 'Editar sensor' : 'Novo sensor' }}
                    </div>
                    <div class="card-body">
                        @if ($ambientes->isEmpty())
                            <div class="alert alert-warning mb-0">
                                Cadastre um <a href="{{ route('ambientes') }}" class="alert-link">ambiente</a> antes de cadastrar sensores.
                            </div>
                        @else
                            <form wire:submit="salvar">
                                <div class="mb-3">
                                    <label for="ambiente_id" class="form-label">Ambiente</label>
                                    <select id="ambiente_id" wire:model="ambiente_id" @class(['form-select', 'is-invalid' => $errors->has('ambiente_id')])>
                                        <option value="">Selecione...</option>
                                        @foreach ($ambientes as $ambiente)
                                            <option value="{{ $ambiente->id }}">{{ $ambiente->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('ambiente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="codigo" class="form-label">Código</label>
                                    <input type="text" id="codigo" placeholder="Ex.: TEMP01, LED01" wire:model="codigo" @class(['form-control', 'is-invalid' => $errors->has('codigo')])>
                                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <input type="text" id="tipo" list="tipos-sensor" placeholder="Ex.: temperatura, led" wire:model="tipo" @class(['form-control', 'is-invalid' => $errors->has('tipo')])>
                                    <datalist id="tipos-sensor">
                                        <option value="temperatura">
                                        <option value="umidade">
                                        <option value="luminosidade">
                                        <option value="led">
                                        <option value="presenca">
                                    </datalist>
                                    @error('tipo') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                        <i class="bi bi-check-lg me-1"></i>{{ $sensorId ? 'Atualizar' : 'Cadastrar' }}
                                    </button>
                                    @if ($sensorId)
                                        <button type="button" class="btn btn-outline-secondary" wire:click="cancelar">Cancelar</button>
                                    @endif
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
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
                                            <button class="btn btn-sm btn-outline-primary" wire:click="editar({{ $sensor->id }})" title="Editar">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" wire:click="excluir({{ $sensor->id }})" wire:confirm="Deseja realmente excluir este sensor?" title="Excluir">
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
    </div>
</div>
