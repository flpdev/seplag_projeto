<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServidorEfetivo;
use Carbon\Carbon;

class ServidorEfetivoController extends Controller
{
    public function index()
    {
        return ServidorEfetivo::with('pessoa')->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pes_id' => 'required|exists:pessoa,id',
            'se_matricula' => 'required|string|max:20',
        ]);

        return ServidorEfetivo::create($data);
    }

    public function show($id)
    {
        return ServidorEfetivo::with('pessoa')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $servidor = ServidorEfetivo::findOrFail($id);

        $data = $request->validate([
            'pes_id' => 'sometimes|exists:pessoa,id',
            'se_matricula' => 'sometimes|string|max:20',
        ]);

        $servidor->update($data);

        return $servidor;
    }

    public function porUnidade($unid_id)
    {
        $servidores = ServidorEfetivo::whereHas('pessoa.lotacoes', function ($query) use ($unid_id) {
            $query->where('unid_id', $unid_id);
        })
        ->with([
            'pessoa' => function ($query) {
                $query->with([
                    'lotacoes.unidade',
                    'fotos' => function ($fotoQuery) {
                        $fotoQuery->latest()->limit(1);
                    }
                ]);
            }
        ])
        ->get()
        ->map(function ($servidor) {
            $pessoa = $servidor->pessoa;

            return [
                'nome' => $pessoa->pes_nome,
                'idade' => Carbon::parse($pessoa->pes_data_nascimento)->age,
                'unidade' => optional($pessoa->lotacoes->first()->unidade)->unid_nome,
                'foto_hash' => optional($pessoa->fotos->first())->fp_hash,
            ];
        });

        return response()->json($servidores);
    }

    public function enderecoFuncionalPorNome(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|min:3',
        ]);
    
        $nome = $request->input('nome');
    
        $servidores = ServidorEfetivo::whereHas('pessoa', function ($query) use ($nome) {
            $query->where('pes_nome', 'like', "%{$nome}%");
        })
        ->with([
            'pessoa.lotacoes.unidade.enderecos.cidade'
        ])
        ->get()
        ->map(function ($servidor) {
            $pessoa = $servidor->pessoa;
    
            $lotacao = $pessoa->lotacoes->first();
            $unidade = optional($lotacao)->unidade;
            $endereco = optional($unidade?->enderecos->first());
            $cidade = optional($endereco?->cidade);
    
            return [
                'servidor' => $pessoa->pes_nome,
                'unidade' => $unidade->unid_nome ?? null,
                'endereco' => [
                    'logradouro' => $endereco->end_logradouro ?? null,
                    'numero' => $endereco->end_numero ?? null,
                    'bairro' => $endereco->end_bairro ?? null,
                    'cidade' => $cidade->cid_nome ?? null,
                    'uf' => $cidade->cid_uf ?? null,
                ],
            ];
        });
    
        return response()->json($servidores);
    }
    
}
