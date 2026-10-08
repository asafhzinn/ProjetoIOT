@if ($ambientes->isEmpty())
    <div class="alert alert-warning mb-0">
        Cadastre um <a href="{{ route('ambientes.create') }}" class="alert-link">ambiente</a> antes de cadastrar sensores.
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
                <i class="bi bi-check-lg me-1"></i>Salvar
            </button>
            <a href="{{ route('sensores.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endif
