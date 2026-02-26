<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\PredictionIntelligence;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // buscamos la primera empresa (la que creamos en el seeder anterior)
        $company = Company::where('name', 'Tecnología Avanzada S.A.')->first();

        if ($company) {
            $data = [
                ['date' => '2025-01-01', 'value' => 1200],
                ['date' => '2025-02-01', 'value' => 1500],
                ['date' => '2025-03-01', 'value' => 1800],
                ['date' => '2025-04-01', 'value' => 2100],
                ['date' => '2025-05-01', 'value' => 2500],
            ];

            foreach ($data as $d) {
                PredictionIntelligence::create([
                    'company_id' => $company->id,
                    'date' => $d['date'],
                    'value' => $d['value']
                ]);
            }
        }
    }
}
