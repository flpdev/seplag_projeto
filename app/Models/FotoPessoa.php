<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoPessoa extends Model
{
    //
    protected $table = 'foto_pessoa';
    protected $fillable = ['pes_id', 'fp_data', 'fp_bucket', 'fp_hash'];
}
