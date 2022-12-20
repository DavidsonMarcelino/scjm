<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anaminese extends Model
{
    protected $table       = 'anaminese';
    protected $primary_key = 'anaminese_id';


    public $timestamps  = false;
    protected $fillable = [
                            'doenca',
                            'medicacao',
                            'tratamento',
                            'operado',
                            'cicatrizacao',
                            'anestesia',
                            'hemorragia',
                            'osso_artificial',
                            'marca_passo',
                            'hipertensao',
                            'diabetes',
                            'insulina',
                            'profissao',
                            'alergia',
                            'gestante',
                            'observacao'
                          ];
}
