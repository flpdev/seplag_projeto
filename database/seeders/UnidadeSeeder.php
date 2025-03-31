<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unidade;


class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $i) {
            Unidade::create([
                'unid_nome' => "Unidade $i",
                'unid_sigla' => "U$i",
            ]);
        }
    }
}
