<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    use HasFactory;
    // campos que se pueden rellenar
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    // castear campos
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime'
    ];


    // Relaciones

    // Un cargo pertenece a un hermano o a varios hermanos
    public function hermano() : HasMany
    {
        return $this->hasMany(Hermano::class);
    }
}
