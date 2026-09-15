<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; font-size: 14px; }
        h1 { color: #2c3e50; border-bottom: 2px solid #2c3e50; padding-bottom: 8px; }
        .info { margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total { text-align: right; margin-top: 20px; font-size: 18px; font-weight: bold; }
        .rodape { margin-top: 40px; text-align: center; color: #999; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Proposta Comercial</h1>

    <div class="info">
        <strong>Título:</strong> {{ $proposta->titulo }} <br>
        <strong>Cliente:</strong> {{ $proposta->cliente->nome }} <br>
        @if ($proposta->cliente->email)
            <strong>E-mail:</strong> {{ $proposta->cliente->email }} <br>
        @endif
        <strong>Data:</strong> {{ $proposta->created_at->format('d/m/Y') }}
                <br>
        @if ($proposta->validade)
            <strong>Válida até:</strong> {{ \Carbon\Carbon::parse($proposta->validade)->format('d/m/Y') }} <br>
        @endif
        <strong>Status:</strong> {{ ucfirst($proposta->status) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Valor Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposta->itens as $item)
                <tr>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($item->quantidade * $item->valor_unitario, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 300px; margin-left: auto; margin-top: 20px;">
        <tr>
            <td style="border: none;">Subtotal:</td>
            <td style="border: none; text-align: right;">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
        </tr>
        @if ($proposta->desconto)
            <tr>
                <td style="border: none;">Desconto ({{ number_format($proposta->desconto, 1, ',', '.') }}%):</td>
                <td style="border: none; text-align: right;">- R$ {{ number_format($valorDesconto, 2, ',', '.') }}</td>
            </tr>
        @endif
        <tr>
            <td style="border: none; font-weight: bold; font-size: 16px;">Total:</td>
            <td style="border: none; text-align: right; font-weight: bold; font-size: 16px;">R$ {{ number_format($total, 2, ',', '.') }}</td>
        </tr>
    </table>

    @if ($proposta->observacoes)
        <div style="margin-top: 30px;">
            <strong>Observações:</strong>
            <p style="margin-top: 6px; color: #555;">{{ $proposta->observacoes }}</p>
        </div>
    @endif

    <div class="rodape">
        Proposta gerada automaticamente • {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>