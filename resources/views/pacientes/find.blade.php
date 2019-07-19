@extends('layouts.app')

@section('content')
<div class="container">
    
    <h3>
        Pacientes 
        <a href="{{ route('pacientes.create') }}" type="button" class="btn btn-primary btn-sm">+ Cadastrar</a>
    </h3>

    <form class="mb-4" method="POST" action="{{ route('pacientes.find') }}">
        @csrf
        <div class="row">
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Procurar Paciente" name="nome" value="">
            </div>
            <div class="col-sm-2">
                <input class="bnt form-control btn-primary" type="submit" value="Enviar"/>
            </div>
        </div>
    </form>

    <table class="table table-dark">
        <tr>
            <td>Nome</td>
            <td>Ano Nascimento </td>
            <td>Dono </td>
            <td>Ações </td>
        </tr>
        @foreach($pacientes as $paciente)
        <tr>
            <td>{{ $paciente->nome }}</td>
            <td>{{ date('d/m/Y',strtotime($paciente->anoNascimento)) }}</td>
            <td>{{ $paciente->cliente->nome }}</td>
            <td>
                <a class="btn btn-primary btn-xs mx-2" href="{{ route('pacientes.edit',[$paciente->id]) }}">Editar</a>
                <form class="d-inline" action="{{ route('pacientes.destroy',[$paciente->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-xs" onclick="return confirm('Deseja realmente apagar?');">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $pacientes->links() }}

</div>
@endsection
