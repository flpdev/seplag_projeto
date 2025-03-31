<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Endereco;
use App\Models\Cidade;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cidades base
        $cidade = Cidade::first() ?? Cidade::create([
            'cid_nome' => 'Cidade Teste',
            'cid_uf' => 'XX',
        ]);

        foreach (range(1, 5) as $i) {
            Endereco::create([
                'end_tipo_logradouro' => 'Rua',
                'end_logradouro' => "Logradouro $i",
                'end_numero' => 100 + $i,
                'end_bairro' => "Bairro $i",
                'cid_id' => $cidade->id,
            ]);
        }
    }
}
