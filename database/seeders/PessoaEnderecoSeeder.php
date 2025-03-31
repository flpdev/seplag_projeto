<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pessoa;
use App\Models\Endereco;
use App\Models\PessoaEndereco;

class PessoaEnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = Pessoa::all();
        $enderecos = Endereco::all();

        foreach ($pessoas as $i => $pessoa) {
            $endereco = $enderecos[$i % $enderecos->count()];
            PessoaEndereco::create([
                'pes_id' => $pessoa->id,
                'end_id' => $endereco->id,
            ]);
        }
    }
}
