<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//------------------------------------------------------------ Model Profissional ----------------------------------------------------------------

class Profissional extends Model{

    protected $table        =   'profissional';
    protected $primaryKey   =   'profissional_id';

    public    $timestamps   =   false;
    protected $fillable     =   [
                                'nome',
                                'data_criado',
                                'data_modificado',
                                'ativo',
                                'deleted'
                                ];
}   