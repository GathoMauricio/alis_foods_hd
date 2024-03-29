<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sucursales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
