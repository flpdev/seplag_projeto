<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServidorTemporario;
use App\Models\Pessoa;

class ServidorTemporarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = Pessoa::limit(5)->pluck('id');

        foreach ($pessoas as $i => $pesId) {
            ServidorTemporario::create([
                'pes_id' => $pesId,
                'st_data_admissao' => now()->subMonths(3),
                'st_data_demissao' => null,
            ]);
        }
    }
}
