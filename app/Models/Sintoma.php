<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sintoma extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sintomas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['servicio_id', 'nombre', 'tiempo_respuesta', 'tiempo_solucion'];

    public function servicio()
    {
        return $this->belongsTo(
            'App\Models\Servicio',
            'servicio_id',
            'id'
        )
            ->withDefault();
    }

    public function sugerencias()
    {
        return $this->hasMany('App\Models\Sugerencia', 'sintoma_id');
    }
}
