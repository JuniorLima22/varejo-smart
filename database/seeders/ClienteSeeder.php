<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::factory()->count(100)->create();
    }
}
