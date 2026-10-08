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
            <i class="bi bi-check-lg me-1"></i>Salvar
        </button>
        <a href="{{ route('ambientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
