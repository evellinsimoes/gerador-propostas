# 📄 Gerador de Propostas Comerciais

Aplicação web para criar, gerenciar e exportar propostas comerciais em PDF. Desenvolvida em **PHP/Laravel**, com foco em automação de um processo real: transformar o preenchimento manual de propostas em um fluxo rápido, com cálculo automático e documento pronto para envio.

> Projeto de portfólio construído do zero, com atenção a validação, segurança, acessibilidade e responsividade.

---

## ✨ Funcionalidades

- **CRUD completo** de clientes e propostas
- **Propostas com múltiplos itens** dinâmicos (adicionar/remover), com **cálculo de total ao vivo** enquanto se digita
- **Desconto percentual**, **validade**, **status** (rascunho / enviada / aceita / recusada) e **observações**
- **Geração de PDF** da proposta (visualizar no navegador ou baixar), com subtotal por item, desconto e total
- **Tema claro/escuro** com persistência entre páginas
- **Interface responsiva** (funciona no celular)
- **Validação em português** com mensagens claras e preservação dos dados digitados
- **Proteção de integridade**: não permite excluir cliente que possui propostas vinculadas

---

## 🛠️ Tecnologias

- **PHP 8 / Laravel** — back-end e rotas
- **Blade** — templates
- **SQLite** — banco de dados
- **dompdf** (barryvdh/laravel-dompdf) — geração de PDF
- **JavaScript** (vanilla) — cálculo ao vivo, modais e interações
- **Bootstrap Icons** — ícones

---

## 🔒 Decisões técnicas de destaque

Alguns pontos que receberam atenção especial no projeto:

- **O total é sempre calculado no servidor** — o cálculo exibido ao vivo no formulário é apenas conveniência; o valor gravado e o do PDF são recalculados no back-end, então não dependem (nem confiam) no que vem do front.
- **Validação em dupla camada** — o navegador dá feedback imediato, mas o servidor valida tudo de novo (desconto entre 0 e 100%, quantidades e valores não negativos, campos obrigatórios, limite de caracteres), com mensagens em português.
- **Escape de dados** — os campos de texto são escapados em todas as camadas (listagem, formulários e PDF), evitando injeção de HTML.
- **Proteção CSRF** ativa em todos os formulários.
- **Acessibilidade** — labels associados aos campos, foco visível, contraste adequado nos dois temas e navegação por teclado nos modais (fecham com `Esc`).

---

## 🚀 Como rodar localmente

```bash
# 1. Clonar o repositório
git clone https://github.com/evellinsimoes/gerador-propostas.git
cd gerador-propostas

# 2. Instalar as dependências
composer install

# 3. Configurar o ambiente
cp .env.example .env
php artisan key:generate

# 4. Criar o banco (SQLite) e rodar as migrations
# (crie o arquivo database/database.sqlite se não existir)
php artisan migrate

# 5. (Opcional) Popular com dados de demonstração
php artisan db:seed --class=DemoSeeder

# 6. Iniciar o servidor
php artisan serve
```

Acesse **http://127.0.0.1:8000**

---

## 📌 Próximos passos (roadmap)

Ideias planejadas para as próximas versões:

- Busca, filtro e paginação na listagem de propostas
- Dados do emissor (nome/logo) no PDF
- Subtotal por linha no formulário
- Máscara de valores monetários

---

Projeto desenvolvido como estudo de desenvolvimento full stack com Laravel.