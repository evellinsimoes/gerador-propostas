<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    // Regras e mensagens (usadas no store e no update)
    private function regras()
    {
        return [
            'nome' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable',
        ];
    }

    private function mensagens()
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.email' => 'Digite um e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
        ];
    }

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->regras(), $this->mensagens());

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate($this->regras(), $this->mensagens());

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->propostas()->count() > 0) {
            return redirect()->route('clientes.index')->with('aviso', 'Não é possível excluir: este cliente tem propostas cadastradas.');
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('sucesso', 'Cliente excluído com sucesso!');
    }
}