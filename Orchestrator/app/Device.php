<?php

namespace App;

use App\Measurement;
use Illuminate\Database\Eloquent\Model;

// Se crea el Modelo para administrar la base de datos.
// Desde este modelo se mapea la table y se limpia el codigo para hacer consultas transparentes
class Device extends Model
{
    // Se crea la propiedad "fillable" para agregar las columnas que queremos insertar de la DB
    protected $fillable = ['uuid', 'enable'];

    public function measurement(){
        return $this->belongsTo(Measurement::class);
    }
}
