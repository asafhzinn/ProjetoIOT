<div data-bs-theme="dark" class="bg-dark text-light min-vh-100 py-4">
    <div class="container">
        <div class="mb-4"><a href="{{ route('sensor.index') }}" class="text-decoration-none text-secondary">←
                Sensores</a>
            <h1 class="h3 mt-2">Editar sensor</h1>
        </div>@include('livewire.partials.alerts')<form wire:submit="atualizar"
            class="card bg-body-tertiary border-secondary-subtle shadow-sm">
            <div class="card-body">
                <div class="mb-3"><label for="ambiente_id" class="form-label">Ambiente *</label><select
                        wire:model="ambiente_id" id="ambiente_id"
                        class="form-select @error('ambiente_id') is-invalid @enderror">
                        <option value="">Selecione um ambiente</option>
                        @foreach ($ambientes as $ambiente)
                            <option value="{{ $ambiente->id }}">{{ $ambiente->nome }}</option>
                        @endforeach
                    </select>
                    @error('ambiente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row g-3">
                    <div class="col-md-6"><label for="codigo" class="form-label">Código *</label><input
                            wire:model="codigo" id="codigo"
                            class="form-control @error('codigo') is-invalid @enderror" type="text" maxlength="255">
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6"><label for="tipo" class="form-label">Tipo *</label><input
                            wire:model="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror"
                            type="text" maxlength="255">
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="my-3"><label for="descricao" class="form-label">Descrição *</label>
                    <textarea wire:model="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror"
                        rows="4" maxlength="5000"></textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check form-switch"><input wire:model="status" id="status" class="form-check-input"
                        type="checkbox"><label for="status" class="form-check-label">Sensor ativo</label></div>
            </div>
            <div class="card-footer border-secondary-subtle d-flex justify-content-end gap-2"><a
                    href="{{ route('sensor.index') }}" class="btn btn-outline-light">Cancelar</a><button
                    wire:loading.attr="disabled" class="btn btn-primary" type="submit"><span
                        wire:loading.remove>Atualizar sensor</span><span wire:loading>Atualizando...</span></button>
            </div>
        </form>
    </div>
</div>
