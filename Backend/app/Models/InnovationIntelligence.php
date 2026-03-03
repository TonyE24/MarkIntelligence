<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InnovationIntelligence extends Model
{
    protected $fillable = [
        'company_id',
        'type',
        'title',
        'description',
        'impact'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
