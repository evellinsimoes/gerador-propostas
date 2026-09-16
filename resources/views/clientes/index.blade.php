@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
    <h1>Clientes Cadastrados</h1>

    <a href="{{ route('clientes.create') }}" class="btn">+ Novo Cliente</a>

    @if (session('sucesso'))
        <div class="sucesso">{{ session('sucesso') }}</div>
    @endif

    @if (session('aviso'))
        <div class="aviso">{{ session('aviso') }}</div>
    @endif

    <table>
        <thead>
            <tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="bi bi-pencil"></i> Editar</a>
                        &nbsp;|&nbsp;
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="event.preventDefault(); abrirModal(this, '{{ addslashes($cliente->nome) }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="link-excluir"><i class="bi bi-trash"></i> Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding:30px; color:#5f6b7a;">
                        Nenhum cliente ainda. <a href="{{ route('clientes.create') }}">Crie o primeiro!</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection