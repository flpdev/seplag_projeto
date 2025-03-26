<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    //
    protected $table = 'lotacao';
    protected $fillable = ['pes_id', 'unid_id', 'lot_data_lotacao', 'lot_data_remocao', 'lot_portaria'];
}
