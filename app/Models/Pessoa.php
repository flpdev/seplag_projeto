<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    //
    protected $table = 'pessoa';
    protected $fillable = ['pes_nome', 'pes_data_nascimento', 'pes_sexo', 'pes_mae', 'pes_pai'];
}
