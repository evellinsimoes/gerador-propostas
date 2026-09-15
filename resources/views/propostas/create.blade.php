@extends('layouts.app')

@section('titulo', 'Nova Proposta')

@section('conteudo')
    <h1>Criar Proposta</h1>

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

    <form action="{{ route('propostas.store') }}" method="POST">
        @csrf

        <label for="cliente_id">Cliente:</label>
        <select id="cliente_id" name="cliente_id" required>
            <option value="">Selecione...</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
            @endforeach
        </select>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>

        <label for="desconto">Desconto (%):</label>
        <input type="number" step="0.01" id="desconto" name="desconto" min="0" max="100" value="{{ old('desconto') }}">

        <label for="validade">Validade:</label>
        <input type="date" id="validade" name="validade" value="{{ old('validade') }}">

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="rascunho" {{ old('status') == 'rascunho' ? 'selected' : '' }}>Rascunho</option>
            <option value="enviada" {{ old('status') == 'enviada' ? 'selected' : '' }}>Enviada</option>
            <option value="aceita" {{ old('status') == 'aceita' ? 'selected' : '' }}>Aceita</option>
            <option value="recusada" {{ old('status') == 'recusada' ? 'selected' : '' }}>Recusada</option>
        </select>

        <label for="observacoes">Observações:</label>
        <textarea id="observacoes" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>

        <hr style="margin: 20px 0;">
        <h3>Itens</h3>

        <div id="itens">
            @forelse (old('itens', []) as $i => $item)
                <div class="item">
                    <input type="text" name="itens[{{ $i }}][descricao]" value="{{ $item['descricao'] ?? '' }}" placeholder="Descrição" aria-label="Descrição do item" required>
                    <input type="number" min="1" name="itens[{{ $i }}][quantidade]" value="{{ $item['quantidade'] ?? '' }}" placeholder="Qtd" aria-label="Quantidade" required>
                    <input type="number" min="0" step="0.01" name="itens[{{ $i }}][valor_unitario]" value="{{ $item['valor_unitario'] ?? '' }}" placeholder="Valor unitário" aria-label="Valor unitário" required>
                    <button type="button" class="btn-remover" onclick="removerItem(this)" aria-label="Remover item"><i class="bi bi-x"></i></button>
                </div>
            @empty
                <div class="item">
                    <input type="text" name="itens[0][descricao]" placeholder="Descrição" aria-label="Descrição do item" required>
                    <input type="number" min="1" name="itens[0][quantidade]" placeholder="Qtd" aria-label="Quantidade" required>
                    <input type="number" min="0" step="0.01" name="itens[0][valor_unitario]" placeholder="Valor unitário" aria-label="Valor unitário" required>
                    <button type="button" class="btn-remover" onclick="removerItem(this)" aria-label="Remover item"><i class="bi bi-x"></i></button>
                </div>
            @endforelse
        </div>

        <br>
        <button type="button" class="btn" onclick="adicionarItem()">+ Adicionar item</button>
        <br>

        <div id="resumo" class="resumo-box">
            <div style="display:flex; justify-content:space-between;">
                <span>Subtotal:</span> <span id="r-subtotal">R$ 0,00</span>
            </div>
            <div style="display:flex; justify-content:space-between;" id="linha-desconto">
                <span>Desconto:</span> <span id="r-desconto">R$ 0,00</span>
            </div>
            <hr style="margin: 8px 0;">
            <div style="display:flex; justify-content:space-between; font-weight:bold; font-size:16px;">
                <span>Total:</span> <span id="r-total">R$ 0,00</span>
            </div>
        </div>

        <br><br>
        <button type="submit" class="btn">Salvar Proposta</button>
        <a href="{{ route('propostas.index') }}" class="btn btn-cancelar">Cancelar</a>
    </form>

    <script>
        let contador = {{ old('itens') ? max(array_keys(old('itens'))) + 1 : 1 }};
        function adicionarItem() {
            const div = document.createElement('div');
            div.classList.add('item');
            div.innerHTML = `
                <input type="text" name="itens[${contador}][descricao]" placeholder="Descrição" aria-label="Descrição do item" required>
                <input type="number" min="1" name="itens[${contador}][quantidade]" placeholder="Qtd" aria-label="Quantidade" required>
                <input type="number" min="0" step="0.01" name="itens[${contador}][valor_unitario]" placeholder="Valor unitário" aria-label="Valor unitário" required>
                <button type="button" class="btn-remover" onclick="removerItem(this)" aria-label="Remover item"><i class="bi bi-x"></i></button>
            `;
            document.getElementById('itens').appendChild(div);
            contador++;
            calcularTotal();
        }

        function removerItem(botao) {
            const itens = document.querySelectorAll('#itens .item');
            if (itens.length > 1) {
                botao.parentElement.remove();
                calcularTotal();
            } else {
                mostrarAviso('A proposta precisa ter pelo menos um item.');
            }
        }

        function calcularTotal() {
            let subtotal = 0;
            document.querySelectorAll('#itens .item').forEach(item => {
                const qtd = parseFloat(item.querySelector('[name*="[quantidade]"]').value) || 0;
                const valor = parseFloat(item.querySelector('[name*="[valor_unitario]"]').value) || 0;
                subtotal += qtd * valor;
            });

            let descPercent = parseFloat(document.querySelector('[name="desconto"]').value) || 0;
            descPercent = Math.min(Math.max(descPercent, 0), 100);
            const valorDesconto = subtotal * (descPercent / 100);
            const total = subtotal - valorDesconto;

            const fmt = (n) => 'R$ ' + n.toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});

            document.getElementById('r-subtotal').textContent = fmt(subtotal);
            document.getElementById('r-desconto').textContent = '- ' + fmt(valorDesconto);
            document.getElementById('r-total').textContent = fmt(total);
        }

        document.addEventListener('input', calcularTotal);
        calcularTotal();
    </script>
@endsection