<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Hermano;

class Patrimonio extends Model
{
    // Campos que se pueden rellenar
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'fecha_adquisicion',
        'valor',
        'ubicacion',
        'observaciones',
        'estado',
        'tipo'
    ];

    // Campos que castear
    protected $casts = [
        'fecha_adquisicion' => 'datetime',
        'valor' => 'float'
    ];

    // Relaciones
    public function hermanos() : BelongsToMany
    {
        return $this->belongsToMany(Hermano::class)->withPivot('asignado_por');
    }
}
