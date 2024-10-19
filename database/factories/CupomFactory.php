<?php

namespace Database\Factories;

use App\Models\Cupom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cupom>
 */
class CupomFactory extends Factory
{
    protected $model = Cupom::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => strtoupper($this->faker->lexify('CUP-??????')),  // Gera algo como CUP-ABC123
            'desconto_percentual' => $this->faker->numberBetween(5, 30),  // Desconto entre 5% e 30%
            'validade' => $this->faker->dateTimeBetween('now', '+1 year'),
            'ativo' => true,
        ];
    }
}
