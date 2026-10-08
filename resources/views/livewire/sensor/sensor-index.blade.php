<div class="mt-0">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="close"></button>
        </div>
    @endif

    <div class="mt-3 mb-3">
        <h2>Sensores</h2>
        <a href= "{{ route('sensor.create')}}">
        <button type="button" class="btn btn-primary">Cadastrar Sensor <i class="bi bi-plus-lg"></i></button></a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ambiente</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sensores as $s)
                    <tr>
                        <td>{{$s->id}}</td>
                        <td>{{ $nomesAmbientes[$s->ambiente_id] ?? 'Ambiente não encontrado' }} </td>
                        <td>{{$s->codigo}}</td>
                        <td>{{$s->tipo}}</td>
                        <td>{{$s->descricao}}</td>
                        <td>
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                            id="status-{{$s->id}}"
                            wire:click='status({{$s->id}})'
                            @checked($s->status)>
                        <span class="badge bg-{{$s->status ? 'success' : 'danger'}}">
                            {{$s->status ? 'Ativo' : 'Inativo'}}</span></div>
                            {{--{{ $a->status ? 'Ativo' : 'Inativo' }}--}}</td>
                        <td>
                        <td>
                            <a href="{{ route('sensor.edit', ['id' => $s->id])}}"
                                class="btn btn-primary btn-sm bi bi-pencil-square"> Editar</a>
                            <button wire:click='delete({{ $s->id }})'
                    class="btn btn-sm btn-danger bi bi-trash3"> Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>