<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MockDataService;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class IntelligenceController extends Controller
{
    protected $mockData;

    // inyectamos el servicio de mock data para tenerlo disponible
    public function __construct(MockDataService $mockData)
    {
        $this->mockData = $mockData;
    }

    /**
     * Endpoint para Inteligencia de Mercado
     * Retorna comparativa de precios y competidores
     */
    public function getMarketData(Request $request)
    {
        $companyId = $request->query('company_id');

        // verificamos que la empresa exista y sea del usuario que pregunta
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada o no tienes acceso'], 404);
        }

        // le pedimos los datos al servicio de mock data segun la industria de la empresa
        $data = $this->mockData->getMarketData($company->industry);

        return response()->json([
            'company_name' => $company->name,
            'industry' => $company->industry,
            'market_analysis' => $data
        ]);
    }

    // Endpoint para Inteligencia de Tendencias (analiza lo que suena en redes)
    public function getTrendData(Request $request)
    {
        $companyId = $request->query('company_id');

        // verificamos la empresa
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada o no tienes acceso'], 404);
        }

        // le pedimos los datos al servicio (sin argumentos, que asi esta definido en el servicio)
        $data = $this->mockData->getTrendData();

        return response()->json([
            'company_name' => $company->name,
            'industry' => $company->industry,
            'trend_analysis' => $data
        ]);
    }

    /**
     * Endpoint para Inteligencia de Predicción (Series temporales)
     */
    public function getPredictionData(Request $request)
    {
        $companyId = $request->query('company_id');
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        $data = $this->mockData->getPredictionData();

        return response()->json([
            'company_name' => $company->name,
            'predictions' => $data
        ]);
    }

    /**
     * Endpoint para Inteligencia de Innovación (Oportunidades)
     */
    public function getInnovationData(Request $request)
    {
        $companyId = $request->query('company_id');
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        $data = $this->mockData->getInnovationData();

        return response()->json([
            'company_name' => $company->name,
            'innovation_opportunities' => $data
        ]);
    }
}
