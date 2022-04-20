<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loja;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Loja::create([
            'nome' => 'Loja 01',
            'email' => 'loja01@loja01.com'
        ]);

        Loja::create([
            'nome' => 'Loja 02',
            'email' => 'loja02@loka02.com'
        ]);

        Loja::create([
            'nome' => 'Loja 03',
            'email' => 'loja03@loka03.com'
        ]);

    }
}
