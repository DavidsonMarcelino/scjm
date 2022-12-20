<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    protected $table       = 'financeiro';
    protected $primary_key = 'financeiro_id';


    public $timestamps  = false;
    protected $fillable = [
                            'tipo',
                            'valor',
                            'data'
                          ];
}
