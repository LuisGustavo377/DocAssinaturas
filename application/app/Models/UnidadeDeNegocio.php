<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeDeNegocio extends Model
{
    use HasFactory;

    protected $table = 'unidades_de_negocio';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'natureza',
    'user_cadastro_id',
    'user_ultima_atualizacao_id',
];

public function grupoDeNegocios()
{
    return $this->belongsTo(GrupoDeNegocios::class);
}

public function carteira()
{
    return $this->hasOne(Carteira::class);
}

public function pessoaFisica()
{
    return $this->hasOne(PessoaFisica::class);
}

public function pessoaJuridica()
{
    return $this->hasOne(PessoaJuridica::class);
}
}
