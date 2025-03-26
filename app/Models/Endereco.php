<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $table = 'endereco';
    protected $fillable = ['end_tipo_logradouro', 'end_logradouro', 'end_numero', 'end_bairro', 'cid_id'];
}
