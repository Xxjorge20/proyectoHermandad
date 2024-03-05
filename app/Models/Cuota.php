<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Hermano;

class Cuota extends Model
{
    use HasFactory;

    // Campos que se pueden rellenar
    protected $fillable = [
        'nombre',
        'descripcion',
        'importe',
        'fecha_emision',
        'fecha_vencimiento',
        'pagada'
    ];

    // Campos que quiero proteger
    protected $hidden = [
        'created_at',
        'updated_at'];


    // Casteo de campos
    protected $casts = [
        'fecha_vencimiento' => 'datetime',
        'importe' => 'float'
    ];

    // Relaciones
    public function hermanos() : BelongsToMany
    {
        return $this->belongsToMany(Hermano::class)->withPivot('asinado_por');
    }
}
