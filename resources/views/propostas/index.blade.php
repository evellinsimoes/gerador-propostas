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
            <tr><th>Título</th><th>Cliente</th><th>Valor</th><th>Status</th><th>Itens</th><th>Ações</th></tr>
        </thead>
        <tbody>
            @foreach ($propostas as $proposta)
                <tr>
                    <td>{{ $proposta->titulo }}</td>
                    <td>{{ $proposta->cliente->nome }}</td>
                    <td><strong>R$ {{ number_format($proposta->total, 2, ',', '.') }}</strong></td>
                    <td><span class="badge badge-{{ $proposta->status }}">{{ ucfirst($proposta->status) }}</span></td>
                    <td>{{ $proposta->itens_count }}</td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('propostas.visualizar', $proposta->id) }}" target="_blank"><i class="bi bi-eye"></i> Visualizar</a>
                        &nbsp;|&nbsp;
                        <a href="{{ route('propostas.pdf', $proposta->id) }}"><i class="bi bi-download"></i> Baixar</a>
                        &nbsp;|&nbsp;
                        <a href="{{ route('propostas.edit', $proposta->id) }}"><i class="bi bi-pencil"></i> Editar</a>
                        &nbsp;|&nbsp;
                        <form action="{{ route('propostas.destroy', $proposta->id) }}" method="POST" style="display:inline;" onsubmit="event.preventDefault(); abrirModal(this);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#c0392b; cursor:pointer; font-size:14px; padding:0;"><i class="bi bi-trash"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection