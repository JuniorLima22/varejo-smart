<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;
    
    protected $fillable = ['nome', 'parent_id'];

    public function subcategorias(): HasMany
    {
        return $this->hasMany(Categoria::class, 'parent_id');
    }

    public function categoriaPai(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }
}
