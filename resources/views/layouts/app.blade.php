<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>@yield('titulo', 'Gerador de Propostas')</title>
    <style>
        :root {
            --fundo: #eef1f5;
            --card: #fff;
            --texto: #2c3e50;
            --titulo: #0c447c;
            --borda: #e4e7eb;
            --borda-input: #d3d9e0;
            --menu-fundo: #f4f6f9;
            --label: #5f6b7a;
            --hover-linha: #f9fafb;
            --perigo: #c0392b;
        }
        body.escuro {
            --fundo: #1a1d23;
            --card: #252a33;
            --texto: #e4e7eb;
            --titulo: #6ab0f3;
            --borda: #3a3f4a;
            --borda-input: #3a3f4a;
            --menu-fundo: #1a1d23;
            --label: #a0a8b3;
            --hover-linha: #2d323c;
            --perigo: #ff8a80;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: var(--fundo);
            color: var(--texto);
            padding: 40px 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 880px;
            margin: 0 auto;
            background: var(--card);
            border-top: 4px solid var(--titulo);
            border-radius: 4px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            overflow: hidden;
            padding: 0 32px 32px;
        }
        .menu {
            margin: 0 -32px 24px;
            padding: 14px 32px;
            background: var(--menu-fundo);
            border-bottom: 1px solid var(--borda);
            display: flex;
            gap: 24px;
        }
        .menu a { font-weight: 600; font-size: 14px; color: var(--titulo); }
        h1 {
            color: var(--titulo);
            font-size: 24px;
            font-weight: 600;
            padding: 28px 32px 20px;
            margin: 0 -32px 24px;
            border-bottom: 1px solid var(--borda);
        }
        h3 { color: var(--titulo); font-size: 16px; margin: 20px 0 10px; }
        a { color: #185fa5; text-decoration: none; }
        a:hover { text-decoration: underline; }
        body.escuro a { color: #6ab0f3; }
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
            color: var(--titulo);
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
            color: var(--label);
            border: 1px solid var(--borda-input);
            box-sizing: border-box;
            margin-left: 8px;
            padding: 10px 20px;
            font-size: 13px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancelar:hover { background: var(--menu-fundo); text-decoration: none; }
        label { display: block; margin-top: 14px; font-weight: 600; font-size: 13px; color: var(--label); }
        input, select, textarea {
            width: 100%;
            padding: 11px;
            margin-top: 5px;
            border: 1px solid var(--borda-input);
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
            background-color: var(--card);
            color: var(--texto);
        }
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235f6b7a' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
        }
        body.escuro select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23a0a8b3' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        }
        input:focus, select:focus, textarea:focus { outline: 2px solid var(--titulo); outline-offset: 2px; border-color: var(--titulo); }
        .tabela-wrapper { margin: 24px 0 12px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: var(--menu-fundo);
            color: var(--label);
            padding: 12px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--titulo);
        }
        td { padding: 13px 12px; border-bottom: 1px solid var(--borda); font-size: 14px; }
        td:last-child { white-space: nowrap; padding-right: 20px; }
        th:last-child { padding-right: 20px; }
        tr:hover td { background: var(--hover-linha); }
        .link-excluir {
            background: none; border: none; color: var(--perigo);
            cursor: pointer; font-size: 14px; padding: 0;
        }
        .sucesso {
            background: #e8f5e9;
            color: #1b5e20;
            padding: 13px 16px;
            border-radius: 4px;
            border-left: 4px solid #2e7d32;
            margin: 18px 0;
            font-size: 14px;
        }
        body.escuro .sucesso { background: #1b2e1f; color: #a3d9a5; }
        .aviso {
            background: #fff8e1;
            color: #8a6d00;
            padding: 13px 16px;
            border-radius: 4px;
            border-left: 4px solid #f0ad4e;
            margin: 18px 0;
            font-size: 14px;
        }
        body.escuro .aviso { background: #2e2a1a; color: #e0c56b; }
        .item { display: flex; gap: 10px; margin-top: 10px; }
        .item input { margin-top: 0; }
        hr { border: none; border-top: 1px solid var(--borda); margin: 24px 0; }

        .resumo-box {
            margin-top: 24px;
            padding: 16px 20px;
            background: var(--menu-fundo);
            border-radius: 6px;
            border-left: 4px solid var(--titulo);
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-rascunho { background: #e4e7eb; color: #4b5563; }
        .badge-enviada { background: #cfe2ff; color: #0c447c; }
        .badge-aceita { background: #d4edda; color: #1b5e20; }
        .badge-recusada { background: #f8d7da; color: #842029; }

        .modal-box { background: var(--card); }
        .modal-texto { color: var(--texto); }

        /* Responsividade — celular e tablet */
        @media (max-width: 768px) {
            body { padding: 15px 10px; }
            .container { padding: 0 16px 20px; overflow-x: hidden; }
            h1 { padding: 20px 16px 16px; margin: 0 -16px 16px; font-size: 20px; }
            .menu { margin: 0 -16px 16px; padding: 12px 16px; }
            table { white-space: nowrap; }
            .item { flex-wrap: wrap; }
            .item input { flex: 1 1 100%; }
        }
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

    <div id="modal-excluir" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
        <div style="padding:28px; border-radius:8px; max-width:380px; text-align:center;" class="modal-box">
            <p style="font-size:16px; margin-bottom:20px;" class="modal-texto" id="texto-excluir">Tem certeza que deseja excluir?</p>
            <button onclick="fecharModal()" class="btn" style="background:#888;">Cancelar</button>
            <button onclick="confirmarExclusao()" class="btn" style="background:#c0392b;">Excluir</button>
        </div>
    </div>

    <div id="modal-aviso" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
        <div style="padding:28px; border-radius:8px; max-width:380px; text-align:center;" class="modal-box">
            <p style="font-size:16px; margin-bottom:20px;" class="modal-texto" id="texto-aviso"></p>
            <button onclick="fecharAviso()" class="btn">OK</button>
        </div>
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

        function abrirModal(form, nome) {
            formParaExcluir = form;
            document.getElementById('texto-excluir').textContent = 'Deseja realmente excluir "' + nome + '"?';
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

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                fecharModal();
                fecharAviso();
            }
        });

        document.getElementById('modal-excluir').addEventListener('click', function(e) {
            if (e.target === this) fecharModal();
        });
        document.getElementById('modal-aviso').addEventListener('click', function(e) {
            if (e.target === this) fecharAviso();
        });
    </script>
</body>
</html>