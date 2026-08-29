<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'report_date', 'organic_weight_kg', 'anorganic_weight_kg', 'notes'
])]
class WasteReport extends Model
{
    protected function casts(): array
    {
        return [
            'report_date' => 'date',
        ];
    }
}
