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
            @forelse ($propostas as $proposta)
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
                        <form action="{{ route('propostas.destroy', $proposta->id) }}" method="POST" style="display:inline;" onsubmit="event.preventDefault(); abrirModal(this, '{{ addslashes($proposta->titulo) }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-excluir"><i class="bi bi-trash"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:30px; color:#5f6b7a;">
                        Nenhuma proposta ainda. <a href="{{ route('propostas.create') }}">Crie a primeira!</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection