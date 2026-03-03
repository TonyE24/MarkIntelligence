<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    // estos son los campos que dejamos que se llenen de un solo (en el create o update)
    protected $fillable = [
        'name',
        'industry',
        'country',
        'region',
        'keywords',
        'user_id',
    ];

    // aqui le avisamos a laravel que 'keywords' no es un simple texto, sino un array/json
    // para que lo convierta automaticamente cuando lo usemos
    protected $casts = [
        'keywords' => 'array',
    ];

    // esta es la relacion: una empresa siempre tiene un dueño (User)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // una empresa tiene muchos registros de datos historicos para prediccion
    public function predictionData()
    {
        return $this->hasMany(PredictionIntelligence::class);
    }

    // una empresa tiene muchos registros de inteligencia de innovacion
    public function innovationData()
    {
        return $this->hasMany(InnovationIntelligence::class);
    }
}
