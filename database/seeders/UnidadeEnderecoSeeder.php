<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unidade;
use App\Models\Endereco;
use App\Models\UnidadeEndereco;

class UnidadeEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = Unidade::all();
        $enderecos = Endereco::all();

        foreach ($unidades as $i => $unidade) {
            $endereco = $enderecos[$i % $enderecos->count()];

            UnidadeEndereco::create([
                'unid_id' => $unidade->id,
                'end_id' => $endereco->id,
            ]);
        }
    }
}
