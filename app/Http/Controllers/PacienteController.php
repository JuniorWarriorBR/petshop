<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Cliente;
use Session;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::paginate(10);

        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();

        return view('pacientes.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Paciente $paciente)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required',
            'nome' => 'required',
            'anoNascimento' => 'required'
        ]);

        $paciente->cliente_id = $request->cliente_id;
        $paciente->nome = $request->nome;
        $paciente->anoNascimento = $request->anoNascimento;        
        $paciente->save();

        Session::flash('success', "Paciente cadastrado!");

        return redirect('pacientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        $clientes = Cliente::all();

        return view('pacientes.edit', compact('paciente','clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required',
            'nome' => 'required',
            'anoNascimento' => 'required'
        ]);

        $paciente = Paciente::find($id);
        $paciente->cliente_id = $request->cliente_id;
        $paciente->nome = $request->nome;
        $paciente->anoNascimento = $request->anoNascimento;        
        $paciente->update();

        Session::flash('success', "Paciente Atualizado!");

        return redirect('pacientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        $paciente->delete();

        Session::flash('success', "Paciente deletado!");

        return redirect('pacientes');
    }

    public function find(Request $request)
    {
        
        $pacientes = Paciente::where('nome','like', '%'.$request->nome.'%')->paginate(10);

        return view('pacientes.find', compact('pacientes'));
    }
}
