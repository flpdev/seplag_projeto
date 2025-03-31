<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pessoa;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $i) {
            Pessoa::create([
                'pes_nome' => "Pessoa $i",
                'pes_data_nascimento' => now()->subYears(20 + $i)->format('Y-m-d'),
                'pes_sexo' => $i % 2 === 0 ? 'Masculino' : 'Feminino',
                'pes_mae' => "Mãe $i",
                'pes_pai' => "Pai $i",
            ]);
        }
    }
}
