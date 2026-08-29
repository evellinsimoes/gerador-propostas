@extends('layouts.app')

@section('titulo', 'Editar Cliente')

@section('conteudo')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ $cliente->nome }}" required>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="{{ $cliente->email }}">
        </div>

        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="{{ $cliente->telefone }}">
        </div>

        <br><br>
        <button type="submit" class="btn">Salvar</button>
    </form>
@endsection