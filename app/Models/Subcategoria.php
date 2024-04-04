<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subcategorias';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['categoria_id', 'nombre'];

    public function categoria()
    {
        return $this->belongsTo(
            'App\Models\Categoria',
            'categoria_id',
            'id'
        )
            ->withDefault();
    }

    public function servicios()
    {
        return $this->hasMany('App\Models\Servicio', 'subcategoria_id');
    }
}
