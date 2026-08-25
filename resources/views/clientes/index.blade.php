<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>
    <h1>Clientes Cadastrados</h1>

    <a href="{{ route('clientes.create') }}">+ Novo Cliente</a>

    <ul>
        @foreach ($clientes as $cliente)
            <li>{{ $cliente->nome }} — {{ $cliente->email }} — {{ $cliente->telefone }}</li>
        @endforeach
    </ul>
</body>
</html>