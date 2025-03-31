<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServidorTemporario;


class ServidorTemporarioController extends Controller
{
    public function index()
    {
        return ServidorTemporario::with('pessoa')->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pes_id' => 'required|exists:pessoa,id',
            'st_data_admissao' => 'required|date',
            'st_data_demissao' => 'nullable|date|after_or_equal:st_data_admissao',
        ]);

        return ServidorTemporario::create($data);
    }

    public function show($id)
    {
        return ServidorTemporario::with('pessoa')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $servidor = ServidorTemporario::findOrFail($id);

        $data = $request->validate([
            'pes_id' => 'sometimes|exists:pessoa,id',
            'st_data_admissao' => 'sometimes|date',
            'st_data_demissao' => 'nullable|date|after_or_equal:st_data_admissao',
        ]);

        $servidor->update($data);

        return $servidor;
    }
}
