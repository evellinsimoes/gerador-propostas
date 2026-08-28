<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Propostas</title>
</head>
<body>
    <h1>Propostas</h1>

    <a href="{{ route('propostas.create') }}">+ Nova Proposta</a>

    {{-- mensagem de sucesso, se houver --}}
    @if (session('sucesso'))
        <p style="color: green;">{{ session('sucesso') }}</p>
    @endif

    <ul>
        @foreach ($propostas as $proposta)
            <li>
                <strong>{{ $proposta->titulo }}</strong>
                — Cliente: {{ $proposta->cliente->nome }}
                — {{ $proposta->itens->count() }} item(ns)

            <a href="{{ route('propostas.pdf', $proposta->id) }}">📄 PDF</a>
            </li>
        @endforeach
    </ul>
</body>
</html>