@extends('layouts.app')

@section('titulo', 'Novo Cliente')

@section('conteudo')
    <h1>Cadastrar Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>E-mail:</label>
        <input type="email" name="email">

        <label>Telefone:</label>
        <input type="text" name="telefone">

        <br><br>
        <button type="submit" class="btn">Salvar</button>
    </form>
@endsection