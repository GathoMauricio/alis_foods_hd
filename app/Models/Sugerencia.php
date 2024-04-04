<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sugerencia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sugerencias';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['sintoma_id', 'nombre'];

    public function sintoma()
    {
        return $this->belongsTo(
            'App\Models\Sintoma',
            'sintoma_id',
            'id'
        )
            ->withDefault();
    }
}
