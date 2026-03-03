<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\InnovationIntelligence;
use Laravel\Sanctum\Sanctum;

class InnovationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que el endpoint retorne datos reales si existen
     */
    public function test_endpoint_innovacion_retorna_datos_reales_si_existen(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Tech Co', 'industry' => 'Tech', 'country' => 'ES', 'region' => 'S', 'user_id' => $user->id
        ]);

        InnovationIntelligence::create([
            'company_id' => $company->id,
            'type' => 'opportunity',
            'title' => 'Oportunidad Real',
            'description' => 'Test Desc',
            'impact' => 'High'
        ]);

        Sanctum::actingAs($user);

        $res = $this->getJson("/api/intelligence/innovation?company_id={$company->id}");

        $res->assertStatus(200)
            ->assertJsonPath('source', 'real_data')
            ->assertJsonPath('innovation_opportunities.0.title', 'Oportunidad Real');
    }

    /**
     * Prueba que el endpoint retorne fallback si no hay datos
     */
    public function test_endpoint_innovacion_retorna_mock_si_no_hay_registros(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Tech Co', 'industry' => 'Tech', 'country' => 'ES', 'region' => 'S', 'user_id' => $user->id
        ]);

        Sanctum::actingAs($user);

        $res = $this->getJson("/api/intelligence/innovation?company_id={$company->id}");

        $res->assertStatus(200)
            ->assertJsonPath('source', 'mock_data');
    }
}
