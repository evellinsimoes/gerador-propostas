@extends('layouts.app')

@section('titulo', 'Clientes')

@section('conteudo')
    <h1>Clientes Cadastrados</h1>

    <a href="{{ route('clientes.create') }}" class="btn">+ Novo Cliente</a>

    <table>
        <thead>
            <tr><th>Nome</th><th>E-mail</th><th>Telefone</th></tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection