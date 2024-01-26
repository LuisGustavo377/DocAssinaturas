<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    use HasFactory;

    protected $table = 'pessoa_juridica';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID


    protected $fillable = [
        'razao_social',
        'cnpj',
        'nome_fantasia',
        'inscricao_estadual',
        'inscricao_municipal',
        'email',
        'tipo_logradouro',
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
    ];


    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function unidadeDeNegocio()
    {
        return $this->belongsTo(UnidadeDeNegocio::class);
    }

    public function tipoDeRelacionamento()
    {
        return $this->HasMany(TipoDeRelacionamento::class);
    }

    public function pessoaJuridicaContaBancaria()
    {
        return $this->HasMany(PessoaJuridicaContaBancaria::class);
    }

    public function pessoaJuridicaTelefone()
    {
        return $this->HasMany(PessoaJuridicaTelefone::class);
    }

}