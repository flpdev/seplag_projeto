<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoPessoa;
use App\Models\Pessoa;

class PessoaFotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pes_id' => 'required|exists:pessoa,id',
            'foto' => 'required|image',
        ]);

        $path = $request->file('foto')->store('', 'minio');

        FotoPessoa::updateOrCreate(
            ['pes_id' => $request->pes_id],
            [
                'fp_data' => now()->toDateString(),
                'fp_bucket' => env('AWS_BUCKET'),
                'fp_hash' => $path,
            ]
        );

        return response()->json(['message' => 'Foto salva com sucesso']);
    }

    public function show($pes_id)
    {
        $foto = FotoPessoa::where('pes_id', $pes_id)->first();

        if (!$foto || !$foto->fp_hash) {
            return response()->json(['message' => 'Foto não encontrada'], 404);
        }

        $url = Storage::disk('minio')->temporaryUrl(
            $foto->fp_hash,
            now()->addMinutes(5)
        );

        return response()->json(['url' => $url]);
    }
}