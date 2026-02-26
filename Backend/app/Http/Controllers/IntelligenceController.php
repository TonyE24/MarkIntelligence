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
     * Aqui usamos el algoritmo de Regresion Lineal para proyectar ventas
     */
    public function getPredictionData(Request $request)
    {
        $companyId = $request->query('company_id');
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        // obtenemos los datos historicos de la base de datos
        $historicalRecords = $company->predictionData()->orderBy('date', 'asc')->get();

        // si no tenemos suficientes datos (al menos 2), usamos los de prueba para no dejar vacio
        if ($historicalRecords->count() < 2) {
            $data = $this->mockData->getPredictionData();
            return response()->json([
                'company_name' => $company->name,
                'predictions' => $data,
                'source' => 'mock_data' // avisamos que son datos simulados
            ]);
        }

        // preparamos los valores para el algoritmo
        $values = $historicalRecords->pluck('value')->toArray();
        
        // queremos predecir los proximos 3 meses
        $proyectedValues = \App\Helpers\LinearRegressionHelper::predict($values, 3);

        // formateamos la respuesta para que el frontend la entienda (meses reales + proyectados)
        $formattedData = $historicalRecords->map(function($record) {
            return [
                'period' => \Carbon\Carbon::parse($record->date)->format('M Y'),
                'actual' => $record->value,
                'predicted' => null
            ];
        })->toArray();

        $lastDate = \Carbon\Carbon::parse($historicalRecords->last()->date);

        foreach ($proyectedValues as $i => $val) {
            $lastDate->addMonth();
            $formattedData[] = [
                'period' => $lastDate->format('M Y'),
                'actual' => null,
                'predicted' => round($val, 2)
            ];
        }

        return response()->json([
            'company_name' => $company->name,
            'predictions' => $formattedData,
            'source' => 'algorithm_prediction'
        ]);
    }

    /**
     * Endpoint para Inteligencia de Innovación (Oportunidades)
     * Detectamos nichos, gaps y tecnologias
     */
    public function getInnovationData(Request $request)
    {
        $companyId = $request->query('company_id');
        $company = Auth::user()->companies()->find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Empresa no encontrada'], 404);
        }

        // intentamos obtener datos reales de la BD
        $innovationData = $company->innovationData()->get();

        // si no hay datos, usamos el fallback de mock data
        if ($innovationData->isEmpty()) {
            $data = $this->mockData->getInnovationData();
            return response()->json([
                'company_name' => $company->name,
                'innovation_opportunities' => $data,
                'source' => 'mock_data'
            ]);
        }

        return response()->json([
            'company_name' => $company->name,
            'innovation_opportunities' => $innovationData,
            'source' => 'real_data'
        ]);
    }
}
