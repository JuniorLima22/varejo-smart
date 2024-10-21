<?php

namespace App\Models;

use App\Enums\StatusVendaEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo_venda',
        'status',
        'data_venda',
        'total',
        'cupom_id',
        'cliente_id',
        'vendedor_id',
        'data_envio_email'
    ];

    protected $casts = [
        'status' => StatusVendaEnum::class,
        'data_venda' => 'datetime:Y-m-d',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($venda): void {
            $venda->codigo_venda = self::gerarCodigoVenda();
        });
    }

    public static function gerarCodigoVenda(): string
    {
        do {
            $codigo = 'VSM-' . strtoupper(uniqid());
        } while (self::where('codigo_venda', $codigo)->exists());

        return $codigo;
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function itens(): HasMany
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function cupom(): BelongsTo
    {
        return $this->belongsTo(Cupom::class);
    }
}
