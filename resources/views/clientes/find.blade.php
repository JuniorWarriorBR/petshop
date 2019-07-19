@extends('layouts.app')

@section('content')
<div class="container">

    <h3>
        Clientes 
        <a href="{{ route('clientes.create') }}" type="button" class="btn btn-primary btn-sm">+ Cadastrar</a>
    </h3>

    <form class="mb-4" method="POST" action="{{ route('clientes.find') }}">
        @csrf
        <div class="row">
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Procurar Cliente" name="nome" value="{{ old('nome') }}">
            </div>
            <div class="col-sm-2">
                <input class="bnt form-control btn-primary" type="submit" value="Enviar"/>
            </div>
        </div>
    </form>

    <table class="table table-dark">
        <tr>
            <td>Nome</td>
            <td>Telefone </td>
            <td>Ações </td>
        </tr>
        @foreach($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>
                <a class="btn btn-primary btn-xs mx-2" href="{{ route('clientes.edit',[$cliente->id]) }}">Editar</a>
                <form class="d-inline" action="{{ route('clientes.destroy',[$cliente->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs" onclick="return confirm('Deseja realmente apagar?');">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $clientes->links() }}
</div>
@endsection
