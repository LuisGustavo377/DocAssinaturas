<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisicaTelefone extends Model
{
    use HasFactory;

    protected $table = 'pessoa_fisica_telefones';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'tipo_de_conta',
    'agencia',
    'numero_conta',
    'digito',
    'status',
    'banco_id',
    'user_cadastro_id',
    'user_ultima_atualizacao_id',
];
}
