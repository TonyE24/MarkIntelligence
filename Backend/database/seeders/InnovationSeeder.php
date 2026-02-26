<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\InnovationIntelligence;

class InnovationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('name', 'Tecnología Avanzada S.A.')->first();

        if ($company) {
            $opportunities = [
                [
                    'type' => 'opportunity',
                    'title' => 'Mercado de Automatización de Almacenes',
                    'description' => 'Detectado un aumento del 30% en interés sobre sistemas de control de inventario en tu región.',
                    'impact' => 'High'
                ],
                [
                    'type' => 'gap',
                    'title' => 'Falta de proveedores de SaaS Local',
                    'description' => 'Las empresas locales buscan software con facturación electrónica adaptada a leyes de El Salvador.',
                    'impact' => 'Medium'
                ],
                [
                    'type' => 'technology',
                    'title' => 'IA Generativa para Atención al Cliente',
                    'description' => 'Implementar chatbots inteligentes podría reducir tus costos operativos en un 40%.',
                    'impact' => 'High'
                ]
            ];

            foreach ($opportunities as $op) {
                InnovationIntelligence::create([
                    'company_id' => $company->id,
                    'type' => $op['type'],
                    'title' => $op['title'],
                    'description' => $op['description'],
                    'impact' => $op['impact']
                ]);
            }
        }
    }
}
