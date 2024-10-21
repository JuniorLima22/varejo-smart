<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Vestuário Feminino' => [
                'Blusas',
                'Camisetas',
                'Vestidos',
                'Saias',
                'Calças',
                'Shorts',
                'Casacos e Jaquetas',
                'Moda íntima',
                'Moda praia (biquínis, maiôs)',
            ],
            'Vestuário Masculino' => [
                'Camisetas',
                'Camisas sociais',
                'Bermudas',
                'Calças',
                'Blazers e Paletós',
                'Jaquetas e Casacos',
                'Moda íntima',
                'Moda praia (sungas, bermudas de praia)',
            ],
            'Vestuário Infantil' => [
                'Roupas para bebês',
                'Roupas para meninos',
                'Roupas para meninas',
                'Conjuntos infantis',
                'Moda praia infantil',
            ],
            'Calçados' => [
                'Tênis',
                'Sapatos sociais',
                'Sandálias e chinelos',
                'Botas',
                'Sapatilhas',
                'Calçados esportivos',
                'Calçados infantis',
            ],
            'Acessórios' => [
                'Bolsas e mochilas',
                'Cintos',
                'Carteiras',
                'Relógios',
                'Chapéus e bonés',
                'Óculos de sol',
                'Lenços e echarpes',
                'Bijuterias (brincos, colares, pulseiras)',
            ],
            'Roupas Esportivas' => [
                'Roupas de academia (leggings, tops, shorts)',
                'Agasalhos esportivos',
                'Camisetas dry fit',
                'Calçados esportivos',
                'Acessórios esportivos (luvas, meias, bonés)',
            ],
            'Roupas de Inverno' => [
                'Casacos e jaquetas',
                'Suéteres',
                'Golas altas',
                'Cachecóis',
                'Gorros e luvas',
                'Meias térmicas',
            ],
            'Moda Íntima' => [
                'Lingerie',
                'Cuecas',
                'Pijamas e camisolas',
                'Roupões',
            ],
            'Moda Praia' => [
                'Biquínis',
                'Sungas',
                'Maiôs',
                'Saídas de praia',
                'Chinelos de praia',
            ],
            'Moda Plus Size' => [
                'Vestuário feminino',
                'Vestuário masculino',
                'Moda íntima plus size',
                'Moda praia plus size',
            ],
        ];

        foreach ($categorias as $categoriaPrincipal => $subcategorias) {
            $categoriaPai = Categoria::create(['nome' => $categoriaPrincipal]);

            foreach ($subcategorias as $subcategoria) {
                Categoria::create([
                    'nome' => $subcategoria,
                    'parent_id' => $categoriaPai->id,
                ]);
            }
        }
    }
}
