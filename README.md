# Petshop

Projeto Petshop com Laravel

1- Criar o projeto:
Abra o terminal na pasta desejada e rode um dos dois comandos para criar o projeto

```
composer create-project --prefer-dist laravel/laravel petshop 
laravel new petshop (Opção pra quem tem o laravel de forma global)
```

2- Entre na pasta do projeto criado

```
cd petshop
```

3- Criar database mysql:
Estou utilizando o usuário e senha php, caso queira fazer igual crie o usuário antes de continuar.
Faço login no mysql -> `mysql -u root -p`

```
CREATE USER 'php'@'localhost' IDENTIFIED BY 'php';
GRANT ALL PRIVILEGES ON * . * TO 'php'@'localhost';
FLUSH PRIVILEGES;
```

use o comando abaixo para criar o database a senha será php neste caso.

```
echo create database petshop | mysql -u php -p
```

4- Edit o arquivo de conexão com o banco mysql
no terminal `vim .env` (ou editor preferido)

```
APP_NAME=Petshop

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petshop
DB_USERNAME=php
DB_PASSWORD=php
```

5-Rodar migrations (banco de dados) nativas (dados dos usuários)

```
php artisan migrate
```

caso sucesso aparecerá algo como isto

```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table
```

Caso tenha Problemas
https://gilbertoalbino.com/laravel-problemas-com-mysql-8-e-eloquent/

Alterar o arquivo `C:\ProgramData\MySQL\MySQL Server 8.0\my.ini`

```
#default_authentication_plugin=caching_sha2_password
default_authentication_plugin=mysql_native_password
```

6- Testando o ambiente:

rode o comando `php artisan serve`
resultado 

```
Laravel development server started: <http://127.0.0.1:8000>
```

acesse http://localhost:8000 A página de boas vindas do laravel deverá aparecer.

7- Ativando autenticação e criação do layout app

```
php artisan make:auth
```

resultado

```
Authentication scaffolding generated successfully.
```

De um refresh na página do laravel e deverá aparecer Login and Register

8- Criar migration e model clientes

```
php artisan make:model Cliente -m  (O parametro -m cria a migration)
```

resultado 

```
Model created successfully.
Created Migration: 2019_07_03_233453_create_clientes_table
```

9-Criar tabela clientes
Abra o arquivo `\petshop\database\migrations\2019_07_03_233453_create_clientes_table.php` e deixe conforme abaixo

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('telefone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
```

rode o comando `php artisan migrate`

resultado

```
Migrating: 2019_07_03_233453_create_clientes_table
Migrated:  2019_07_03_233453_create_clientes_table
```

10- Criar controller 

rode o comando

```
php artisan make:controller ClienteController --resource
```

resultado 

```
Controller created successfully.
```

Arquivo criado
`\petshop\app\Http\Controllers\ClienteController.php`

11- Criar rotas

Edite o arquivo `\petshop\routes\web.php`

Adicione as rotas abaixo

Cria todas as Rotas utilizadas no projeto.

```php
Route::resource('clientes', 'ClienteController')->middleware('auth');
Route::post('cliente', 'ClienteController@find')->name('clientes.find')->middleware('auth');
```

para verificar as rotas criadas rode o comando 

```
php artisan route:list
```

resultado

```
+--------+-----------+-------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                     | Name             | Action                                                                 | Middleware   |
+--------+-----------+-------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                       |                  | Closure                                                                | web          |
|        | GET|HEAD  | api/user                |                  | Closure                                                                | api,auth:api |
|        | POST      | cliente                 | clientes.find    | App\Http\Controllers\ClienteController@find                            | web,auth     |
|        | POST      | clientes                | clientes.store   | App\Http\Controllers\ClienteController@store                           | web,auth     |
|        | GET|HEAD  | clientes                | clientes.index   | App\Http\Controllers\ClienteController@index                           | web,auth     |
|        | GET|HEAD  | clientes/create         | clientes.create  | App\Http\Controllers\ClienteController@create                          | web,auth     |
|        | DELETE    | clientes/{cliente}      | clientes.destroy | App\Http\Controllers\ClienteController@destroy                         | web,auth     |
|        | PUT|PATCH | clientes/{cliente}      | clientes.update  | App\Http\Controllers\ClienteController@update                          | web,auth     |
|        | GET|HEAD  | clientes/{cliente}      | clientes.show    | App\Http\Controllers\ClienteController@show                            | web,auth     |
|        | GET|HEAD  | clientes/{cliente}/edit | clientes.edit    | App\Http\Controllers\ClienteController@edit                            | web,auth     |
|        | GET|HEAD  | home                    | home             | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | POST      | login                   |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD  | login                   | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | logout                  | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email          | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD  | password/reset          | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset          | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset/{token}  | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | POST      | register                |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD  | register                | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
+--------+-----------+-------------------------+------------------+------------------------------------------------------------------------+--------------+
```

12- Crud

Iniciando pela Index

Adicionar as duas linhas no Controller cliente

```php
use App\Cliente;
use Session;
```

Método index

```php
public function index()
    {
        $clientes = Cliente::paginate(10);

        return view('clientes.index', compact('clientes'));
    }
```

Necessário criar a view dos clientes.

Criado a pasta clientes dentro de views e o arquivos `index.blade.php`

```
\petshop\resources\views\clientes\index.blade.php
```

Modelo html

```php
@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1><a style="text-decoration:none; color:black;" href="{{ route('clientes.index') }}">Petshop</a></h1>
    <h3>
        Clientes 
        <a href="{{ route('clientes.create') }}" type="button" class="btn btn-primary btn-sm">+ Cadastrar</a>
    </h3>

    <form class="mb-4" method="POST" action="{{ route('clientes.find') }}">
        @csrf
        <div class="row">
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Procurar Cliente" name="nome" value="">
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
```

Método Create

```php
 public function create()
    {
        return view('clientes.create');
    }

Criado arquivo \petshop\resources\views\clientes\create.blade.php

@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>
        <a style="text-decoration:none; color:black;"href="{{ route('clientes.index') }}">Petshop</a>
    </h1>

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
```

Método store

Inserção do cliente e retorno para pagina clientes

```php
    public function store(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
        ]);

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;
        $cliente->save();

        Session::flash('success', "Cliente cadastrado!");

        return redirect('clientes');
    }
```


Editando cliente, retorna para view com o cliente selecionado.

```php
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', compact('cliente'));
    }
```

Criado arquivo `\petshop\resources\views\clientes\edit.blade.php`

```php
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
```

Método update

```php
 public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
        ]);

        // $cliente->id = $id;

        $cliente = Cliente::find($id);
        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;
        $cliente->update();

        Session::flash('success', "Cliente atualizado!");

        return redirect('clientes');
    }
```

Método destroy

```php
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        $cliente->delete();

        Session::flash('success', "Cliente deletado!");

        return redirect('clientes');
    }
```

Método find

```php
    public function find(Request $request)
    {
        
        $clientes = Cliente::where('nome','like', '%'.$request->nome.'%')->get();


        return view('clientes.find', compact('clientes'));
    }
```


Criado arquivo `\petshop\resources\views\clientes\find.blade.php`

```php
@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1><a style="text-decoration:none; color:black;" href="{{ route('clientes.index') }}">Petshop</a></h1>
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

</div>
@endsection
```

Ativando as notificações

Acesse o arquivo `\petshop\resources\views\layouts\app.blade.php` e adicione o css e js do Toastr

Obs: Comente o arquivo app.js que esta no head

```php
<!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->

<!-- Toast -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script src="{{ asset('js/app.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>    
    
    @if(Session::has('success'))     
        toastr.success("{{ Session::get('success') }}")
    @endif

</script>
```
