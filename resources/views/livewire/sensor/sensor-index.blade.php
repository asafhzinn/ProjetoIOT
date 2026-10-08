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
                        <th>Id</th>
                        <th>Ambiente</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Campos</th>
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
                        <td>{{ $s->status ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('sensor.edit', ['id' => $s->id])}}"
                                class="btn btn-primary btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" wire:confirm="Deseja excluir o sensor">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>