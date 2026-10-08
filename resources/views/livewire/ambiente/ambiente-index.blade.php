<div class="mt-0">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="close"></button>
        </div>
    @endif

    <div class="mt-3 mb-3">
        <h2>Ambientes</h2>
        <a href= "{{ route('ambiente.create')}}">
        <button type="button" class="btn btn-primary">Cadastrar Ambiente <i class="bi bi-plus-lg"></i></button></a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($ambientes as $a)
                    <tr>
                        <td>{{$a->id}}</td>
                        <td>{{$a->nome}}</td>
                        <td>{{$a->descricao}}</td>
                        <td>{{ $a->status ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <a href="{{ route('ambiente.edit', ['id' => $a->id])}}"
                                class="btn btn-primary btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" wire:confirm="Deseja excluir o ambiente">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>