@extends('layouts.app')

@section('titulo', 'Editar Proposta')

@section('conteudo')
    <h1>Editar Proposta</h1>

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

    <form action="{{ route('propostas.update', $proposta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Cliente:</label>
        <select name="cliente_id" required>
            <option value="">Selecione...</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ $proposta->cliente_id == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>

        <label>Título:</label>
        <input type="text" name="titulo" value="{{ old('titulo', $proposta->titulo) }}" required>

        <label>Desconto (%):</label>
        <input type="text" name="desconto" value="{{ old('desconto', $proposta->desconto) }}">

        <hr style="margin: 20px 0;">
        <h3>Itens</h3>

        <div id="itens">
            @foreach ($proposta->itens as $i => $item)
                <div class="item">
                    <input type="text" name="itens[{{ $i }}][descricao]" value="{{ $item->descricao }}" placeholder="Descrição" required>
                    <input type="number" name="itens[{{ $i }}][quantidade]" value="{{ $item->quantidade }}" placeholder="Qtd" required>
                    <input type="number" step="0.01" name="itens[{{ $i }}][valor_unitario]" value="{{ $item->valor_unitario }}" placeholder="Valor unitário" required>
                    <button type="button" class="btn-remover" onclick="removerItem(this)"><i class="bi bi-x"></i></button>
                </div>
            @endforeach
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
        <button type="submit" class="btn">Salvar Alterações</button>
        <a href="{{ route('propostas.index') }}" class="btn btn-cancelar">Cancelar</a>
    </form>

    <script>
        let contador = {{ $proposta->itens->count() }};
        function adicionarItem() {
            const div = document.createElement('div');
            div.classList.add('item');
            div.innerHTML = `
                <input type="text" name="itens[${contador}][descricao]" placeholder="Descrição" required>
                <input type="number" name="itens[${contador}][quantidade]" placeholder="Qtd" required>
                <input type="number" step="0.01" name="itens[${contador}][valor_unitario]" placeholder="Valor unitário" required>
                <button type="button" class="btn-remover" onclick="removerItem(this)"><i class="bi bi-x"></i></button>
            `;
            document.getElementById('itens').appendChild(div);
            contador++;
        }

        function removerItem(botao) {
            const itens = document.querySelectorAll('#itens .item');
            if (itens.length > 1) {
                botao.parentElement.remove();
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

            const descPercent = parseFloat(document.querySelector('[name="desconto"]').value) || 0;
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