<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table       = 'convenio';
    protected $primary_key = 'convenio_id';


    public $timestamps  = false;
    protected $fillable = [
                          'nome',
                          'data_criado',
                          'data_modificado',
                          'ativo',
                          'deleted'
                          ];
}
