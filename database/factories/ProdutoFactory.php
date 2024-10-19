<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Produto>
 */
class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    private static $nomes = [
        'Camiseta Básica',
        'Calça Jeans',
        'Tênis Esportivo',
        'Blusa de Frio',
        'Relógio de Pulso',
        'Bolsa de Couro',
        'Sapatilha Feminina',
        'Jaqueta Corta Vento',
        'Chinelo Havaianas',
        'Óculos de Sol'
    ];

    private static $descricoes = [
        'Produto de alta qualidade, fabricado com materiais duráveis.',
        'Excelente para o dia a dia, combina com diversos estilos.',
        'Confortável e moderno, ideal para todas as ocasiões.',
        'Disponível em várias cores e tamanhos, ajuste perfeito.',
        'Feito no Brasil, com garantia de 1 ano.',
        'Ótima escolha para presentear alguém especial.',
        'Design exclusivo e acabamento impecável.',
        'Produto versátil, perfeito para dias mais frios.',
        'Alta durabilidade, ideal para prática de esportes.',
        'Leve e resistente, fácil de combinar com diferentes looks.'
    ];

    private static $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = self::$nomes[self::$index];
        $descricao = self::$descricoes[self::$index];

        self::$index++;

        if (self::$index >= count(self::$nomes)) {
            self::$index = 0;
        }

        $precoCompra = $this->faker->randomFloat(2, 10, 100);

        return [
            'nome' => $nome,
            'descricao' => $descricao,
            'preco_compra' => $precoCompra,
            'preco_venda' => $precoCompra * 1.30, // 30% a mais do que o preço de compra
            'quantidade' => $this->faker->numberBetween(1, 100),
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
        ];
    }
}
