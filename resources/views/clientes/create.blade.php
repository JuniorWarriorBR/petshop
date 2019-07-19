@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Clientes <small>Criar</small></h3>

    <form class="mb-4" action="{{ route('clientes.store') }}" method="POST">
    	@csrf
        <div class="row">
            <div class="col-sm-5">
            	<input type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="Nome Cliente" name="nome" value="{{ old('nome') }}">
            </div>

            <div class="col-sm-5">
            	<input type="text" class="form-control @error('telefone') is-invalid @enderror" placeholder="Telefone Cliente" name="telefone" value="{{ old('telefone') }}">
            </div>

            <div class="col-sm-2">
            	<input class="bnt form-control btn-primary" type="submit" value="Salvar"/>
            </div>
        </div>
    </form>

</div>
@endsection
