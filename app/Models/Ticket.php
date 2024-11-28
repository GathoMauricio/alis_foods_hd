<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'estatus_id',
        'sintoma_id',
        'autor_id',
        'tecnico_id',
        'folio',
        'descripcion',
        'detalle_proceso_terceros',
        'detalle_finalizado',
        'sla',
        'tipo_finalizado',
        'proceso_at',
        'cerrado_at',
        'finalizado_at',
        'mantenimiento',
    ];

    public function estatus()
    {
        return $this->belongsTo(
            'App\Models\TicketEstatus',
            'estatus_id',
            'id'
        )
            ->withDefault();
    }

    public function sintoma()
    {
        return $this->belongsTo(
            'App\Models\Sintoma',
            'sintoma_id',
            'id'
        )
            ->withDefault();
    }

    public function autor()
    {
        return $this->belongsTo(
            'App\Models\User',
            'autor_id',
            'id'
        )
            ->withDefault();
    }

    public function tecnico()
    {
        return $this->belongsTo(
            'App\Models\User',
            'tecnico_id',
            'id'
        )
            ->withDefault();
    }

    public function seguimientos()
    {
        return $this->hasMany('App\Models\Seguimiento', 'ticket_id');
    }

    public function adjuntos()
    {
        return $this->hasMany('App\Models\Adjunto', 'ticket_id');
    }
}
