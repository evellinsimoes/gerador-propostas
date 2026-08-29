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
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="bi bi-pencil"></i> Editar</a>
                        &nbsp;|&nbsp;
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
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