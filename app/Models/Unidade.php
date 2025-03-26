<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    //
    protected $table = 'unidade';
    protected $fillable = ['unid_nome', 'unid_sigla'];
}
