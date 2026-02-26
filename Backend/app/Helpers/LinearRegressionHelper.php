<?php

namespace App\Helpers;

class LinearRegressionHelper
{
    /**
     * Calcula la regresion lineal simple para un conjunto de datos (x, y)
     * y = mx + b
     */
    public static function predict(array $data, int $periodsToPredict): array
    {
        $n = count($data);
        if ($n < 2) {
            return []; // no podemos predecir con menos de 2 puntos
        }

        $sumX = 0;
        $sumY = 0;
        $sumXY = 0;
        $sumX2 = 0;

        // x sera el indice del tiempo (1, 2, 3...)
        // y sera el valor de venta
        foreach ($data as $i => $y) {
            $x = $i + 1;
            $sumX += $x;
            $sumY += $y;
            $sumXY += ($x * $y);
            $sumX2 += ($x * $x);
        }

        // calculamos la pendiente (m) y la interseccion (b)
        // m = (n*sumXY - sumX*sumY) / (n*sumX2 - sumX^2)
        $denominator = ($n * $sumX2) - ($sumX * $sumX);
        
        if ($denominator == 0) return []; // evitar division por cero

        $m = (($n * $sumXY) - ($sumX * $sumY)) / $denominator;
        $b = ($sumY - ($m * $sumX)) / $n;

        $predictions = [];
        // calculamos los puntos para los proximos periodos
        for ($i = 1; $i <= $periodsToPredict; $i++) {
            $futureX = $n + $i;
            $predictions[] = ($m * $futureX) + $b;
        }

        return $predictions;
    }
}
