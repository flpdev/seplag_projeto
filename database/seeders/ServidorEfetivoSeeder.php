<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServidorEfetivo;
use App\Models\Pessoa;

class ServidorEfetivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pessoas = Pessoa::limit(5)->pluck('id');

        foreach ($pessoas as $i => $pesId) {
            ServidorEfetivo::create([
                'pes_id' => $pesId,
                'se_matricula' => 'EFETIVO' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
