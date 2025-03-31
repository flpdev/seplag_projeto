<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Unidade;

class LotacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = Pessoa::limit(5)->pluck('id');
        $unidades = Unidade::limit(5)->pluck('id');

        foreach ($pessoas as $i => $pesId) {
            Lotacao::create([
                'pes_id' => $pesId,
                'unid_id' => $unidades[$i % count($unidades)],
                'lot_data_lotacao' => now()->subDays(10),
                'lot_data_remocao' => null,
                'lot_portaria' => 'PORT-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
