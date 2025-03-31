<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lotacao;


class LotacaoController extends Controller
{
    public function index()
    {
        return Lotacao::with(['pessoa', 'unidade'])->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pes_id' => 'required|exists:pessoa,id',
            'unid_id' => 'required|exists:unidade,id',
            'lot_data_lotacao' => 'required|date',
            'lot_data_remocao' => 'nullable|date|after_or_equal:lot_data_lotacao',
            'lot_portaria' => 'nullable|string',
        ]);

        return Lotacao::create($data);
    }

    public function show($id)
    {
        return Lotacao::with(['pessoa', 'unidade'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $lotacao = Lotacao::findOrFail($id);

        $data = $request->validate([
            'pes_id' => 'sometimes|exists:pessoa,id',
            'unid_id' => 'sometimes|exists:unidade,id',
            'lot_data_lotacao' => 'sometimes|date',
            'lot_data_remocao' => 'nullable|date|after_or_equal:lot_data_lotacao',
            'lot_portaria' => 'nullable|string',
        ]);

        $lotacao->update($data);

        return $lotacao;
    }
}
