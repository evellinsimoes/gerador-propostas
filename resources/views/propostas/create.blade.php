<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Proposta</title>
</head>
<body>
    <h1>Criar Proposta</h1>

    <form action="{{ route('propostas.store') }}" method="POST">
        @csrf

        {{-- Escolher o cliente (menu suspenso) --}}
        <div>
            <label>Cliente:</label>
            <select name="cliente_id" required>
                <option value="">Selecione...</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Título:</label>
            <input type="text" name="titulo" required>
        </div>

        <div>
            <label>Desconto (R$):</label>
            <input type="number" step="0.01" name="desconto">
        </div>

        <hr>
        <h3>Itens</h3>

        {{-- Onde os itens vão aparecer --}}
        <div id="itens">
            <div class="item">
                <input type="text" name="itens[0][descricao]" placeholder="Descrição" required>
                <input type="number" name="itens[0][quantidade]" placeholder="Qtd" required>
                <input type="number" step="0.01" name="itens[0][valor_unitario]" placeholder="Valor unitário" required>
            </div>
        </div>

        <button type="button" onclick="adicionarItem()">+ Adicionar item</button>
        <br><br>
        <button type="submit">Salvar Proposta</button>
    </form>

    {{-- JavaScript que adiciona novos itens --}}
    <script>
        let contador = 1;
        function adicionarItem() {
            const div = document.createElement('div');
            div.classList.add('item');
            div.innerHTML = `
                <input type="text" name="itens[${contador}][descricao]" placeholder="Descrição" required>
                <input type="number" name="itens[${contador}][quantidade]" placeholder="Qtd" required>
                <input type="number" step="0.01" name="itens[${contador}][valor_unitario]" placeholder="Valor unitário" required>
            `;
            document.getElementById('itens').appendChild(div);
            contador++;
        }
    </script>
</body>
</html>