<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicios';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['subcategoria_id', 'nombre'];

    public function subcategoria()
    {
        return $this->belongsTo(
            'App\Models\Subcategoria',
            'subcategoria_id',
            'id'
        )
            ->withDefault();
    }

    public function sintomas()
    {
        return $this->hasMany('App\Models\Sintoma', 'servicio_id');
    }
}
