<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sucursal_id',
        'categoria_id',
        'name',
        'apaterno',
        'amaterno',
        'email',
        'telefono',
        'telefono_emergencia',
        'foto',
        'password',
        'distrital',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sucursal()
    {
        return $this->belongsTo(
            'App\Models\Sucursal',
            'sucursal_id',
            'id'
        )
            ->withDefault();
    }

    public function categoria()
    {
        return $this->belongsTo(
            'App\Models\Categoria',
            'categoria_id',
            'id'
        )
            ->withDefault();
    }
}
