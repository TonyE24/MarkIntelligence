<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PredictionIntelligence extends Model
{
    // establecemos los campos que se pueden llenar masivamente
    protected $fillable = [
        'company_id',
        'date',
        'value'
    ];

    // relacion: este dato historico pertenece a una empresa
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
