<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeDeNegocioContaBancaria extends Model
{
    use HasFactory;

    
    protected $table = 'unidades_de_negocio_contas_bancarias';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'tipo_de_conta',
    'agencia',
    'numero_conta',
    'banco_id',
    'status',
    'user_cadastro_id',
    'user_ultima_atualizacao_id',
];

public function unidadeDeNegocio()
{
    return $this->belongsTo(UnidadeDeNegocio::class, 'unidade_de_negocio_id');
}

public function banco()
{
    return $this->belongsTo(Banco::class, 'banco_id');
}


}