<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketEstatus extends Model
{
    use HasFactory;

    protected $table = 'ticket_estatuses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['id', 'nombre'];
}
