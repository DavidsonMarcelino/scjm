<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table       = 'agenda';
    protected $primary_key = 'agenda_id';


    public $timestamps  = false;
    protected $fillable = [
                            'usuario_id',
                            'paciente_id',
                            'procedimento_id',
                            'status',
                            'data_inicio',
                            'data_criado',
                            'data_modificado',
                            'ativo',
                            'deleted'
                          ];
}
