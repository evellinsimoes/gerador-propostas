<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposta;
use App\Models\Cliente;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propostas = Proposta::all();
        return view('propostas.index', compact('propostas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('propostas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. valida os dados
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'titulo' => 'required',
            'itens' => 'required|array|min:1',
            'itens.*.descricao' => 'required',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.valor_unitario' => 'required|numeric|min:0',
        ]);

        // 2. cria a proposta
        $proposta = Proposta::create([
            'cliente_id' => $request->cliente_id,
            'titulo' => $request->titulo,
            'desconto' => $request->desconto,
        ]);

        // 3. cria cada item ligado a essa proposta
        foreach ($request->itens as $item) {
            $proposta->itens()->create($item);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
