<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;


class PessoaController extends Controller
{
    public function index()
    {
        return Pessoa::paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pes_nome' => 'required|string|max:200',
            'pes_data_nascimento' => 'required|date',
            'pes_sexo' => 'required|in:Masculino,Feminino,Outro',
            'pes_mae' => 'required|string|max:200',
            'pes_pai' => 'required|string|max:200',
        ]);

        return Pessoa::create($data);
    }

    public function show($id)
    {
        return Pessoa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::findOrFail($id);

        $data = $request->validate([
            'pes_nome' => 'sometimes|string|max:200',
            'pes_data_nascimento' => 'sometimes|date',
            'pes_sexo' => 'sometimes|in:Masculino,Feminino,Outro',
            'pes_mae' => 'sometimes|string|max:200',
            'pes_pai' => 'sometimes|string|max:200',
        ]);

        $pessoa->update($data);

        return $pessoa;
    }
}
