<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable =[
        'id','tipodocumento_id','numero_documento','nombres','apellido_paterno',
        'apellido_materno','telefono_celular','telefono_fijo','sexo'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the tipo_doumento that owns the Persona
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipodocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
