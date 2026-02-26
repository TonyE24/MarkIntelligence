<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\PredictionIntelligence;
use App\Helpers\LinearRegressionHelper;
use Laravel\Sanctum\Sanctum;

class PredictionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba el algoritmo de regresion lineal puro
     */
    public function test_algoritmo_regresion_lineal_calcula_correctamente(): void
    {
        // datos lineales perfectos: y = 10x + 0 (10, 20, 30...)
        $datos = [10, 20, 30, 40, 50];
        
        // queremos predecir el siguiente (x=6), deberia ser 60
        $prediccion = LinearRegressionHelper::predict($datos, 1);
        
        $this->assertEquals(60, round($prediccion[0]));
    }

    /**
     * Prueba el endpoint con datos reales en la BD
     */
    public function test_endpoint_prediccion_usa_datos_reales_si_existen(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Test Co', 'industry' => 'Tech', 'country' => 'ES', 'region' => 'S', 'user_id' => $user->id
        ]);

        // insertamos datos historicos (3 meses)
        PredictionIntelligence::create(['company_id' => $company->id, 'date' => '2024-01-01', 'value' => 100]);
        PredictionIntelligence::create(['company_id' => $company->id, 'date' => '2024-02-01', 'value' => 200]);
        PredictionIntelligence::create(['company_id' => $company->id, 'date' => '2024-03-01', 'value' => 300]);

        Sanctum::actingAs($user);

        $res = $this->getJson("/api/intelligence/predictions?company_id={$company->id}");

        $res->assertStatus(200)
            ->assertJsonPath('source', 'algorithm_prediction')
            // debe tener 3 historicos + 3 predicciones = 6 en total
            ->assertJsonCount(6, 'predictions');
    }

    /**
     * Prueba el fallback a mock data si no hay datos suficientes
     */
    public function test_endpoint_prediccion_usa_mock_data_si_no_hay_historicos(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Test Co', 'industry' => 'Tech', 'country' => 'ES', 'region' => 'S', 'user_id' => $user->id
        ]);

        Sanctum::actingAs($user);

        $res = $this->getJson("/api/intelligence/predictions?company_id={$company->id}");

        $res->assertStatus(200)
            ->assertJsonPath('source', 'mock_data');
    }
}
