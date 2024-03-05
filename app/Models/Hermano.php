<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Hermano extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable, HasApiTokens;

    // campos que se pueden rellenar
    protected $table = 'hermanos';

    protected $fillable = [
        'nombre',
        'apellidos',
        'dni',
        'email',
        'password',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'fecha_bautismal',
        'fecha_alta',
        'cargo_id',
    ];

    // campos que quiero proteger
    protected $hidden = [
        'password'
    ];

    // Casteo de campos
    protected $casts = [
        'fecha_nacimiento' => 'datetime',
        'fecha_bautismal' => 'datetime',
        'fecha_alta' => 'datetime',
        'password' => 'hashed'
    ];

    // Relaciones

    // Cultos N:M
    public function cultos() : BelongsToMany
    {
        return $this->belongsToMany(Culto::class)->withPivot('asignado_por');
    }

    // Patrimonio N:M
    public function patrimonio() : BelongsToMany
    {
        return $this->belongsToMany(Patrimonio::class)->withPivot('asignado_por');
    }


    // Cuotas N:M
    public function cuotas() : BelongsToMany
    {
        return $this->belongsToMany(Cuota::class)->withPivot('asignado_por');
    }



    // cargos 1:N
    // Un hermano puede tener un solo cargo
    public function cargo() : BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}

