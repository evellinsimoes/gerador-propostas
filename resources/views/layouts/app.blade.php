<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
        .menu {
            margin: 0 -32px 24px;
            padding: 14px 32px;
            background: #f4f6f9;
            border-bottom: 1px solid #e4e7eb;
            display: flex;
            gap: 24px;
        }
        .menu a { font-weight: 600; font-size: 14px; color: #0c447c; }
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            box-sizing: border-box;
            line-height: 1;
        }
        .btn:hover { background: #185fa5; text-decoration: none; }
        .btn-tema {
            margin-left: auto;
            background: transparent;
            border: none;
            width: 36px; height: 36px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            color: #0c447c;
        }
        .btn-tema:hover { background: rgba(0,0,0,0.06); }
        .btn-remover {
            background: #c0392b; color: #fff; border: none;
            border-radius: 4px; cursor: pointer; padding: 0 12px;
            font-size: 16px;
        }
        .btn-remover:hover { background: #a93226; }
        .btn-cancelar {
            background: transparent;
            color: #5f6b7a;
            border: 1px solid #d3d9e0;
            box-sizing: border-box;
            margin-left: 8px;
            padding: 10px 20px;
            font-size: 13px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancelar:hover { background: #f4f6f9; text-decoration: none; }
        body.escuro .btn-cancelar { color: #a0a8b3; border-color: #3a3f4a; }
        body.escuro .btn-cancelar:hover { background: #1a1d23; }
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
        .aviso {
            background: #fff8e1;
            color: #8a6d00;
            padding: 13px 16px;
            border-radius: 4px;
            border-left: 4px solid #f0ad4e;
            margin: 18px 0;
            font-size: 14px;
        }
        .item { display: flex; gap: 10px; margin-top: 10px; }
        .item input { margin-top: 0; }
        hr { border: none; border-top: 1px solid #e4e7eb; margin: 24px 0; }
        
        body.escuro { background: #1a1d23; color: #e4e7eb; }
        body.escuro .container { background: #252a33; border-top-color: #4a90d9; }
        body.escuro h1, body.escuro h3 { color: #6ab0f3; border-bottom-color: #3a3f4a; }
        body.escuro .menu { background: #1a1d23; border-bottom-color: #3a3f4a; }
        body.escuro .menu a { color: #6ab0f3; }
        body.escuro label { color: #a0a8b3; }
        body.escuro input, body.escuro select { background: #1a1d23; border-color: #3a3f4a; color: #e4e7eb; }
        body.escuro th { background: #1a1d23; color: #a0a8b3; }
        body.escuro td { border-bottom-color: #3a3f4a; }
        body.escuro tr:hover td { background: #2d323c; }
        body.escuro hr { border-top-color: #3a3f4a; }
        body.escuro .btn-tema { color: #6ab0f3; background: transparent; }
        body.escuro a { color: #6ab0f3; }
        body.escuro .aviso { background: #2e2a1a; color: #e0c56b; }
        body.escuro .modal-box { background: #252a33 !important; }
        body.escuro .modal-texto { color: #e4e7eb !important; }

        /* Responsividade — celular e tablet */
        @media (max-width: 768px) {
            body { padding: 15px 10px; }
            .container { padding: 0 16px 20px; }

            h1 { padding: 20px 16px 16px; margin: 0 -16px 16px; font-size: 20px; }
            .menu { margin: 0 -16px 16px; padding: 12px 16px; }

            /* tabela vira rolável na horizontal em vez de cortar */
            .container { overflow-x: hidden; }
            table { display: block; overflow-x: auto; white-space: nowrap; }

            /* os campos de item empilham em vez de espremer */
            .item { flex-wrap: wrap; }
            .item input { flex: 1 1 100%; }

        }

        .resumo-box {
            margin-top: 24px;
            padding: 16px 20px;
            background: #f4f6f9;
            border-radius: 6px;
            border-left: 4px solid #0c447c;
        }
        body.escuro .resumo-box { background: #1a1d23; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="menu">
            <a href="{{ route('propostas.index') }}">Propostas</a>
            <a href="{{ route('clientes.index') }}">Clientes</a>
            <button id="btn-tema" onclick="alternarTema()" class="btn-tema" title="Alternar tema"><i class="bi bi-moon"></i></button>
        </nav>
        @yield('conteudo')
    </div>   

        <script>
        if (localStorage.getItem('tema') === 'escuro') {
            document.body.classList.add('escuro');
            document.getElementById('btn-tema').innerHTML = '<i class="bi bi-sun"></i>';
        }

        function alternarTema() {
            document.body.classList.toggle('escuro');
            const escuro = document.body.classList.contains('escuro');
            document.getElementById('btn-tema').innerHTML = escuro ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
            localStorage.setItem('tema', escuro ? 'escuro' : 'claro');
        }

        let formParaExcluir = null;

        function abrirModal(form) {
            formParaExcluir = form;
            document.getElementById('modal-excluir').style.display = 'flex';
        }
        function fecharModal() {
            document.getElementById('modal-excluir').style.display = 'none';
            formParaExcluir = null;
        }
        function confirmarExclusao() {
            if (formParaExcluir) formParaExcluir.submit();
        }
        function mostrarAviso(mensagem) {
            document.getElementById('texto-aviso').textContent = mensagem;
            document.getElementById('modal-aviso').style.display = 'flex';
        }
        function fecharAviso() {
            document.getElementById('modal-aviso').style.display = 'none';
        }
    </script>
    <div id="modal-excluir" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:28px; border-radius:8px; max-width:380px; text-align:center;" class="modal-box">
            <p style="font-size:16px; margin-bottom:20px; color:#2c3e50;" class="modal-texto">Tem certeza que deseja excluir?</p>
            <button onclick="fecharModal()" class="btn" style="background:#888;">Cancelar</button>
            <button onclick="confirmarExclusao()" class="btn" style="background:#c0392b;">Excluir</button>
        </div>
    </div>
    <div id="modal-aviso" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:28px; border-radius:8px; max-width:380px; text-align:center;" class="modal-box">
            <p style="font-size:16px; margin-bottom:20px; color:#2c3e50;" class="modal-texto" id="texto-aviso"></p>
            <button onclick="fecharAviso()" class="btn">OK</button>
        </div>
    </div>
</body>
</html>