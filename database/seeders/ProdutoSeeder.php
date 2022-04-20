<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;


class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::create([
            'nome' => 'Produto01_01',
            'valor' => '15.50',
            'loja_id' => '1',
            'ativo' => '1'
        ]);

        Produto::create([
            'nome' => 'Produto02_01',
            'valor' => '36.36',
            'loja_id' => '1',
            'ativo' => '1'
        ]);

        Produto::create([
            'nome' => 'Produto03_01',
            'valor' => '65.65',
            'loja_id' => '1',
            'ativo' => '1'
        ]);

        Produto::create([
            'nome' => 'Produto01_02',
            'valor' => '135.51',
            'loja_id' => '2',
            'ativo' => '1'
        ]);
    }
}
