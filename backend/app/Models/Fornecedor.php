<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'cnpj',
        'nome',
        'situacao'
    ];

    protected $dates = ['deleted_at'];

    public function materiais(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
