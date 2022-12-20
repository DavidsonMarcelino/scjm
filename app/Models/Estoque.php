<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table       = 'estoque';
    protected $primary_key = 'estoque_id';


    public $timestamps  = false;
    protected $fillable = [
                          'material_id',
                          'quantidade',
                          'validade',
                          'lote',
                          'custo'
                          ];
}
