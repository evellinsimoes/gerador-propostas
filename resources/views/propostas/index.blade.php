@extends('layouts.app')

@section('titulo', 'Propostas')

@section('conteudo')
    <h1>Propostas</h1>

    <a href="{{ route('propostas.create') }}" class="btn">+ Nova Proposta</a>

    @if (session('sucesso'))
        <div class="sucesso">{{ session('sucesso') }}</div>
    @endif

    <table>
        <thead>
            <tr><th>Título</th><th>Cliente</th><th>Itens</th><th>PDF</th></tr>
        </thead>
        <tbody>
            @foreach ($propostas as $proposta)
                <tr>
                    <td>{{ $proposta->titulo }}</td>
                    <td>{{ $proposta->cliente->nome }}</td>
                    <td>{{ $proposta->itens->count() }}</td>
                    <td><a href="{{ route('propostas.pdf', $proposta->id) }}">📄 Baixar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection