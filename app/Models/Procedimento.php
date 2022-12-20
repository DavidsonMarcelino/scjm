<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $table       = 'procedimento';
    protected $primary_key = 'procedimento_id';


    public $timestamps  = false;
    protected $fillable = [
                          'nome',
                          'preco',
                          'tempo',
                          'recorrencia',
                          'data_criado',
                          'data_modificado',
                          'ativo',
                          'deleted'
                          ];
}
