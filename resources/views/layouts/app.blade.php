<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Gerador de Propostas')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #eef1f5;
            color: #2c3e50;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 820px;
            margin: 0 auto;
            background: #fff;
            border-top: 4px solid #0c447c;
            border-radius: 4px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            overflow: hidden;
            padding: 0 32px 32px;
        }
        h1 {
            color: #0c447c;
            font-size: 24px;
            font-weight: 600;
            padding: 28px 32px 20px;
            margin: 0 -32px 24px;
            border-bottom: 1px solid #e4e7eb;
        }
        h3 { color: #0c447c; font-size: 16px; margin: 20px 0 10px; }
        a { color: #185fa5; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .btn {
            display: inline-block;
            background: #0c447c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-top: 8px;
        }
        .btn:hover { background: #185fa5; text-decoration: none; }
        label { display: block; margin-top: 14px; font-weight: 600; font-size: 13px; color: #5f6b7a; }
        input, select {
            width: 100%;
            padding: 11px;
            margin-top: 5px;
            border: 1px solid #d3d9e0;
            border-radius: 4px;
            font-size: 14px;
        }
        input:focus, select:focus { outline: none; border-color: #0c447c; }
        table { width: 100%; border-collapse: collapse; margin: 24px 0 12px; }
        th {
            background: #f4f6f9;
            color: #5f6b7a;
            padding: 12px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #0c447c;
        }
        td { padding: 13px 12px; border-bottom: 1px solid #eaedf1; font-size: 14px; }
        tr:hover td { background: #f9fafb; }
        .sucesso {
            background: #e8f5e9;
            color: #1b5e20;
            padding: 13px 16px;
            border-radius: 4px;
            border-left: 4px solid #2e7d32;
            margin: 18px 0;
            font-size: 14px;
        }
        .item { display: flex; gap: 10px; margin-top: 10px; }
        .item input { margin-top: 0; }
        hr { border: none; border-top: 1px solid #e4e7eb; margin: 24px 0; }
    </style>
</head>
<body>
    <div class="container">
        @yield('conteudo')
    </div>
</body>
</html>