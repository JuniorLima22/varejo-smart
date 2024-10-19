<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cupom extends Model
{
    use HasFactory;
    
    protected $table = 'cupons';
    protected $fillable = [
        'codigo',
        'desconto_percentual',
        'validade',
        'ativo'
    ];

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }
}
