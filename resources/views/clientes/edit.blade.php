@extends('layouts.app')

@section('content')
<div class="container">
    
	<h1>
		<a style="text-decoration:none; color:black;"href="{{ route('clientes.index') }}">Petshop</a>
	</h1>

    <h3>Clientes <small>Editar</small></h3>

    <form class="mb-4" action="{{ route('clientes.update',[$cliente->id]) }}" method="POST">
        @method('PUT')
    	@csrf
        <div class="row">
            <div class="col-sm-5">
            	<input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $cliente->nome }}">
            </div>

            <div class="col-sm-5">
            	<input type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $cliente->telefone }}">
            </div>

            <div class="col-sm-2">
            	<input class="bnt form-control btn-primary" type="submit" value="Alterar"/>
            </div>
        </div>
    </form>

</div>
@endsection
