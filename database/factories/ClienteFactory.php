<?php

namespace Database\Factories;

use App\Models\Cliente;
use Faker\Provider\pt_BR\Address;
use Faker\Provider\pt_BR\PhoneNumber;
use Faker\Provider\pt_PT\Internet;
use Faker\Provider\pt_PT\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Address($faker));
        $faker->addProvider(new Internet($faker));

        return [
            'nome' => $faker->unique()->name,
            'cpf' => $faker->unique()->cpf(true),
            'telefone' => $faker->phoneNumber,
            'email' => $faker->unique()->email,
            'cep' => $faker->postcode,
            'logradouro' => $faker->streetName,
            'numero' => $faker->buildingNumber,
            'cidade' => $faker->city,
            'bairro' => $faker->streetSuffix,
            'complemento' => $faker->optional()->secondaryAddress,
            'user_id' => rand(1,4),
        ];
    }
}
