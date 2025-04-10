<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'nome' => 'Cliente Exemplo1',
            'endereco' =>  'Rua exemplo1, 123',
            'telefone' => '18 99999-9999',
            'cpf' => '123.456.789-90',
            'email' => 'cliente1@example.com',
            'senha' => bcrypt('senha123')
        ]);

        Cliente::create([
            'nome' => 'Cliente Exemplo2',
            'endereco' =>  'Rua exemplo2, 345',
            'telefone' => '18 88888-8888',
            'cpf' => '908.765.432-11',
            'email' => 'cliente2@example.com',
            'senha' => bcrypt('senha123')
        ]);

        Cliente::create([
            'nome' => 'Cliente Exemplo3',
            'endereco' =>  'Rua exemplo3, 678',
            'telefone' => '18 77777-7777',
            'cpf' => '756-924-292-88',
            'email' => 'cliente3@example.com',
            'senha' => bcrypt('senha123')
        ]);
    }

    
}
