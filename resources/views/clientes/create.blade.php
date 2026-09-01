@extends('layouts.app')

@section('titulo', 'Novo Cliente')

@section('conteudo')
    <h1>Cadastrar Cliente</h1>

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

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}" required>

        <label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Telefone:</label>
        <input type="text" name="telefone" value="{{ old('telefone') }}">

        <br><br>
        <button type="submit" class="btn">Salvar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-cancelar">Cancelar</a>
    </form>
@endsection