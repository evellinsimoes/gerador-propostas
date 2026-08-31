<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposta;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class PropostaController extends Controller
{
    // Regras de validação (usadas no store e no update)
    private function regras()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'titulo' => 'required',
            'desconto' => 'nullable|numeric|min:0|max:100',
            'itens' => 'required|array|min:1',
            'itens.*.descricao' => 'required',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.valor_unitario' => 'required|numeric|min:0',
        ];
    }

    // Mensagens de erro em português (usadas no store e no update)
    private function mensagens()
    {
        return [
            'cliente_id.required' => 'Selecione um cliente.',
            'titulo.required' => 'O título é obrigatório.',
            'desconto.max' => 'O desconto não pode ser maior que 100%.',
            'desconto.min' => 'O desconto não pode ser negativo.',
            'desconto.numeric' => 'O desconto deve ser um número.',
            'itens.required' => 'Adicione pelo menos um item.',
            'itens.min' => 'Adicione pelo menos um item.',
            'itens.*.descricao.required' => 'A descrição do item é obrigatória.',
            'itens.*.quantidade.required' => 'A quantidade é obrigatória.',
            'itens.*.quantidade.min' => 'A quantidade deve ser no mínimo 1.',
            'itens.*.valor_unitario.required' => 'O valor unitário é obrigatório.',
            'itens.*.valor_unitario.min' => 'O valor não pode ser negativo.',
        ];
    }

    public function index()
    {
        $propostas = Proposta::with('cliente')->withCount('itens')->latest()->get();
        return view('propostas.index', compact('propostas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('propostas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate($this->regras(), $this->mensagens());

        $proposta = Proposta::create([
            'cliente_id' => $request->cliente_id,
            'titulo' => $request->titulo,
            'desconto' => $request->desconto,
        ]);

        foreach ($request->itens as $item) {
            $proposta->itens()->create($item);
        }

        return redirect()->route('propostas.index')->with('sucesso', 'Proposta criada com sucesso!');
    }

    public function gerarPdf(Proposta $proposta)
    {
        $dados = $this->calcularValores($proposta);
        $pdf = Pdf::loadView('pdf.proposta', $dados);
        return $pdf->download('proposta-' . $proposta->id . '.pdf');
    }

    public function visualizarPdf(Proposta $proposta)
    {
        $dados = $this->calcularValores($proposta);
        $pdf = Pdf::loadView('pdf.proposta', $dados);
        return $pdf->stream('proposta-' . $proposta->id . '.pdf');
    }

    private function calcularValores(Proposta $proposta)
    {
        $proposta->load('cliente', 'itens');

        $subtotal = 0;
        foreach ($proposta->itens as $item) {
            $subtotal += $item->quantidade * $item->valor_unitario;
        }
        $valorDesconto = $subtotal * (($proposta->desconto ?? 0) / 100);
        $total = $subtotal - $valorDesconto;

        return [
            'proposta' => $proposta,
            'subtotal' => $subtotal,
            'valorDesconto' => $valorDesconto,
            'total' => $total,
        ];
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Proposta $proposta)
    {
        $proposta->load('itens');
        $clientes = Cliente::all();
        return view('propostas.edit', compact('proposta', 'clientes'));
    }

    public function update(Request $request, Proposta $proposta)
    {
        $request->validate($this->regras(), $this->mensagens());

        $proposta->update([
            'cliente_id' => $request->cliente_id,
            'titulo' => $request->titulo,
            'desconto' => $request->desconto,
        ]);

        $proposta->itens()->delete();
        foreach ($request->itens as $item) {
            $proposta->itens()->create($item);
        }

        return redirect()->route('propostas.index')->with('sucesso', 'Proposta atualizada com sucesso!');
    }

    public function destroy(Proposta $proposta)
    {
        $proposta->itens()->delete();
        $proposta->delete();

        return redirect()->route('propostas.index')->with('sucesso', 'Proposta excluída com sucesso!');
    }
}