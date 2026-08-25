<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente</title>
</head>
<body>
    <h1>Cadastrar Cliente</h1>

    {{-- O form envia os dados para a rota clientes.store --}}
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf {{-- proteção de segurança obrigatória no Laravel --}}

        <div>
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label>E-mail:</label>
            <input type="email" name="email">
        </div>

        <div>
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>