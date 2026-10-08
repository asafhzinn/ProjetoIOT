<div class="mt-0">
    <div class="card mt-3">
        <h5 class="card-header">Cadastro de Ambientes</h5>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input id="nome" type="text" class="form-control" wire:model="nome" required>
                    @error('nome') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea id="descricao" class="form-control" rows="4" wire:model="descricao"></textarea>
                    @error('descricao') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check form-switch">
                        <input id="status" class="form-check-input" type="checkbox" role="switch" wire:model="status">
                        <label for="status" class="form-check-label">{{ $status ? 'Ativo' : 'Inativo' }}</label>
                    </div>
                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('ambiente.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>