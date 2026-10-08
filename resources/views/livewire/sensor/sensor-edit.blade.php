<div class="mt-0">
    <div class="card mt-3">
        <h5 class="card-header">Editar Sensor</h5>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input id="codigo" type="text" class="form-control" wire:model="codigo" required>
                    @error('codigo') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input id="tipo" type="text" class="form-control" wire:model="tipo" placeholder="Ex.: temperatura, umidade" required>
                    @error('tipo') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea id="descricao" class="form-control" rows="4" wire:model="descricao" required></textarea>
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
                <button type="submit" class="btn btn-primary" >Salvar</button>
                <a href="{{ route('sensor.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>