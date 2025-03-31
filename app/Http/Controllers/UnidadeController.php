<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;


class UnidadeController extends Controller
{
    public function index()
    {
        return Unidade::with('enderecos')->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'unid_nome' => 'required|string|max:200',
            'unid_sigla' => 'required|string|max:20',
        ]);

        return Unidade::create($data);
    }

    public function show($id)
    {
        return Unidade::with('enderecos')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $unidade = Unidade::findOrFail($id);

        $data = $request->validate([
            'unid_nome' => 'sometimes|string|max:200',
            'unid_sigla' => 'sometimes|string|max:20',
        ]);

        $unidade->update($data);

        return $unidade;
    }
}
