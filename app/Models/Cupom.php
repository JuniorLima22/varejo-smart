<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $casts = [
        'validade' => 'datetime',
    ];

    public function isValid()
    {
        // Garantir que 'data_expiracao' é uma instância de Carbon
        return $this->validade instanceof Carbon && $this->validade->isFuture();
    }

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }
}
