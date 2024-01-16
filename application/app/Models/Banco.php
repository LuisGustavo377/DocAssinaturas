<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    // Início Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
    // Fim Configuração UUID

    public function contasEstabelecimento()
    {
        return $this->hasMany(ContasEstabelecimento::class, 'codigo_banco');
    }
}