<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Hermano;

class Culto extends Model
{
        use HasFactory;
        // Campos que se pueden rellenar
        protected $fillable = [
            'nombre',
            'descripcion',
            'fecha',
            'hora',
            'lugar',
            'aforo',
            'imagen',
        ];

        protected $casts = [
            'fecha' => 'datetime',
            'hora' => 'datetime',
        ];

        // Relaciones

        // Hermanos N:M
        public function hermanos() : BelongsToMany
        {
            return $this->belongsToMany(Hermano::class)->withPivot('asignado_por');
        }
}
