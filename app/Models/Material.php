<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table       = 'material';
    protected $primary_key = 'material_id';

    public $timestamps  = false;
    protected $fillable = [
                          'nome',
                          'marca',
                          'tipo',
                          'quantidade_reposicao',
                          'data_criado',
                          'data_modificado',
                          'ativo',
                          'deleted'
                          ];
}
