<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table       = 'paciente';
    protected $primary_key = 'paciente_id';


    public $timestamps  = false;
    protected $fillable = [
                          'anaminese_id',
                          'convenio_id',
                          'nome',
                          'sexo',
                          'foto',
                          'data_nascimento',
                          'data_criado',
                          'data_modificado',
                          'ativo',
                          'deleted'
                          ];
}
