@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Pacientes <small>Criar</small></h3>

    <form class="mb-4" action="{{ route('pacientes.store') }}" method="POST">
    	@csrf
        <div class="row">
            <div class="col-sm-4">
            	<input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome Paciente" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="col-sm-4">
            	<input type="date" class="form-control @error('anoNascimento') is-invalid @enderror" placeholder="Nascimento Paciente" name="anoNascimento" value="{{ old('anoNascimento') }}">
            </div>

            <div class="col-sm-4">
            <select  class="form-control @error('cliente_id') is-invalid @enderror" name="cliente_id">
                @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                @endforeach
            </select>
            </div>            
        </div>
        <div class="row mt-4">
            <div class="col-sm-12">
            	<input class="bnt form-control btn-primary btn-block" type="submit" value="Salvar"/>
            </div>
        </div>
    </form>

</div>
@endsection
