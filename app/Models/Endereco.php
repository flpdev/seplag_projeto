<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $table = 'endereco';
    protected $fillable = ['end_tipo_logradouro', 'end_logradouro', 'end_numero', 'end_bairro', 'cid_id'];


    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cid_id');
    }

    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'pessoa_endereco', 'end_id', 'pes_id');
    }

    public function unidades()
    {
        return $this->belongsToMany(Unidade::class, 'unidade_endereco', 'end_id', 'unid_id');
    }
}
