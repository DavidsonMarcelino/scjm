<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table       = 'usuario';
    protected $primary_key = 'usuario_id';


    public $timestamps  = false;
    protected $fillable = [
                            'profissional_id',
                            'permissao',
                            'nome',
                            'login',
                            'senha',
                            'data_criado',
                            'data_modificado',
                            'ativo',
                            'deleted'
                          ];
}
