<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $table       = 'arquivo';
    protected $primary_key = 'arquivo_id';


    public $timestamps  = false;
    protected $fillable = [
                            'nome',
                            'header',
                            'footer',
                            'tipo_arquivo',
                            'data_criado',
                            'data_modificado',
                            'ativo',
                            'deleted'
                          ];
}
