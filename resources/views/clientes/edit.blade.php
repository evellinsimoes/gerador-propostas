@extends('layouts.app')

@section('titulo', 'Editar Cliente')

@section('conteudo')
    <h1>Editar Cliente</h1>

    @if ($errors->any())
        <div class="aviso">
            <strong>Corrija os seguintes erros:</strong>
            <ul style="margin: 8px 0 0 20px;">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}">

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}">

        <br><br>
        <button type="submit" class="btn">Salvar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-cancelar">Cancelar</a>
    </form>
@endsection