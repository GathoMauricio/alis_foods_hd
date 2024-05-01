<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistritalSucursal extends Model
{
    use HasFactory;

    protected $table = 'distrital_sucursales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'sucursal_id'];
}
