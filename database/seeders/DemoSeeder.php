<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\ItemProposta;
use App\Models\Proposta;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Remove dados antigos respeitando as chaves estrangeiras (itens -> propostas -> clientes)
        ItemProposta::query()->delete();
        Proposta::query()->delete();
        Cliente::query()->delete();

        $construtora = Cliente::create([
            'nome' => 'Construtora Horizonte Ltda',
            'email' => 'contato@construtorahorizonte.com.br',
            'telefone' => '11987654321',
        ]);

        $mercado = Cliente::create([
            'nome' => 'Mercado Bom Preço S.A.',
            'email' => 'financeiro@mercadobompreco.com.br',
            'telefone' => '21998765432',
        ]);

        $clinica = Cliente::create([
            'nome' => 'Clínica Vida Saudável',
            'email' => 'administrativo@clinicavidasaudavel.com.br',
            'telefone' => '31991234567',
        ]);

        $propostaSite = Proposta::create([
            'cliente_id' => $construtora->id,
            'titulo' => 'Desenvolvimento de site institucional',
            'desconto' => null,
            'validade' => now()->addDays(30)->toDateString(),
            'status' => 'rascunho',
            'observacoes' => 'Proposta válida para pagamento em até 3x. Prazo de entrega estimado em 45 dias úteis após aprovação.',
        ]);

        foreach ([
            ['descricao' => 'Design de interface (UI/UX)', 'quantidade' => 1, 'valor_unitario' => 2500.00],
            ['descricao' => 'Desenvolvimento frontend responsivo', 'quantidade' => 1, 'valor_unitario' => 3200.00],
            ['descricao' => 'Integração com formulário de contato', 'quantidade' => 1, 'valor_unitario' => 800.00],
            ['descricao' => 'Hospedagem e configuração inicial', 'quantidade' => 1, 'valor_unitario' => 450.00],
        ] as $item) {
            $propostaSite->itens()->create($item);
        }

        $propostaAutomacao = Proposta::create([
            'cliente_id' => $mercado->id,
            'titulo' => 'Consultoria de automação de processos',
            'desconto' => 10,
            'validade' => now()->addDays(20)->toDateString(),
            'status' => 'enviada',
            'observacoes' => 'Inclui treinamento da equipe e suporte por 30 dias após a implantação.',
        ]);

        foreach ([
            ['descricao' => 'Diagnóstico de processos internos', 'quantidade' => 1, 'valor_unitario' => 1800.00],
            ['descricao' => 'Implementação de automação de estoque', 'quantidade' => 1, 'valor_unitario' => 4200.00],
            ['descricao' => 'Treinamento da equipe (8h)', 'quantidade' => 2, 'valor_unitario' => 350.00],
        ] as $item) {
            $propostaAutomacao->itens()->create($item);
        }

        $propostaSistema = Proposta::create([
            'cliente_id' => $clinica->id,
            'titulo' => 'Sistema de gestão interna',
            'desconto' => 15,
            'validade' => now()->addDays(15)->toDateString(),
            'status' => 'aceita',
            'observacoes' => 'Sistema inclui agendamento de consultas, prontuário eletrônico e emissão de relatórios.',
        ]);

        foreach ([
            ['descricao' => 'Levantamento de requisitos', 'quantidade' => 1, 'valor_unitario' => 1200.00],
            ['descricao' => 'Desenvolvimento do módulo de agendamento', 'quantidade' => 1, 'valor_unitario' => 3800.00],
            ['descricao' => 'Desenvolvimento do módulo de prontuário eletrônico', 'quantidade' => 1, 'valor_unitario' => 4500.00],
            ['descricao' => 'Migração de dados e treinamento', 'quantidade' => 1, 'valor_unitario' => 950.00],
        ] as $item) {
            $propostaSistema->itens()->create($item);
        }
    }
}
