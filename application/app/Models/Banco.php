<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'nome',
        'status',
        'observacao',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',

    ];

    public function pessoaJuridicaContaBancaria()
    {
        return $this->hasMany(PessoaJuridicaContaBancaria::class, 'codigo_banco');
    }

    public function pessoaFisicaContaBancaria()
    {
        return $this->hasMany(PessoaFisicaContaBancaria::class, 'codigo_banco');
    }
}