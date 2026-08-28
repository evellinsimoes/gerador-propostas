<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Gerador de Propostas')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; color: #333; padding: 30px; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        a { color: #2c7be5; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .btn { display: inline-block; background: #2c7be5; color: #fff; padding: 10px 18px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; }
        .btn:hover { background: #1a68d1; text-decoration: none; }
        label { display: block; margin-top: 12px; font-weight: 600; font-size: 14px; }
        input, select { width: 100%; padding: 10px; margin-top: 4px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: #fff; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .sucesso { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin: 15px 0; }
        .item { display: flex; gap: 8px; margin-top: 8px; }
    </style>
</head>
<body>
    <div class="container">
        @yield('conteudo')
    </div>
</body>
</html>