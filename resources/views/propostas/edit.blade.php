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
        <input type="text" name="titulo" value="{{ $proposta->titulo }}" required>

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
        <br><br>
        <button type="submit" class="btn">Salvar Alterações</button>
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
    </script>
@endsection