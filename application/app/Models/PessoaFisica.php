<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    use HasFactory;

    protected $table = 'pessoa_fisica';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID


    protected $fillable = [
        'nome', 
        'cpf', 
        'email',
        'telefone',
        'tipo_de_logradouro',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado_id',
        'cidade_id',
        'senha',
        'senha_temporaria',
        'status',
        'imagem',
        'unidade_negocio_id',
        'user_cadastro_id',
        'ser_ultima_atualizacao_id'
 
    ];


    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function unidadeDeNegocio()
    {
        return $this->belongsTo(UnidadeDeNegocio::class);
    }

    public function tipoDeRelacionamento()
    {
        return $this->HasMany(TipoDeRelacionamento::class);
    }

    public function pessoaFisicaContaBancaria()
    {
        return $this->hasMany(PessoaFisicaContaBancaria::class);
    }

    public function pessoaJuridicaContaBancaria()
    {
        return $this->hasMany(PessoaJuridicaContaBancaria::class);
    }

}