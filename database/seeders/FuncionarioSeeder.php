<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Funcionario::create([
            'nome' => 'Funcionario Exemplo1',
            'cpf' => '876.123.124-99',
            'email' => 'funcionario1@example.com',
            'senha' => bcrypt('senha123')

        ]);

        Funcionario::create([
            'nome' => 'Funcionario Exemplo2',
            'cpf' => '453.124.653-11',
            'email' => 'funcionario2@example.com',
            'senha' => bcrypt('senha123')

        ]);

       

        // Produto::factory()->count(15)->create();
    }
}
