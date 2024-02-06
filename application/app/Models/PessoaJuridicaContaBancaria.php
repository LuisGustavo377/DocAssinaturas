<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridicaContaBancaria extends Model
{
    use HasFactory;

    
    protected $table = 'pessoa_juridica_conta_bancaria';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'tipo_de_conta',
    'agencia',
    'numero_conta',
    'codigo_banco',
    'digito',
    'status',
    'pessoa_fisica_id',
    'banco_id',
    'user_cadastro_id',
    'user_ultima_atualizacao_id',
];

public function pessoaJuridica()
{
    return $this->belongsTo(PessoaJuridicaContaBancaria::class);
}

public function banco()
{
    return $this->belongsTo(Banco::class);
}
}