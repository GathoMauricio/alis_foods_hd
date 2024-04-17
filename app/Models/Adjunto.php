<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adjunto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'adjuntos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['autor_id', 'ticket_id', 'ruta', 'descripcion', 'mimetype'];

    public function autor()
    {
        return $this->belongsTo(
            'App\Models\User',
            'autor_id',
            'id'
        )
            ->withDefault();
    }

    public function ticket()
    {
        return $this->belongsTo(
            'App\Models\Ticket',
            'ticket_id',
            'id'
        )
            ->withDefault();
    }
}
