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
        'imagem',
        'senha',
        'senha_temporaria',
        'unidade_de_negocio_id',
        'user_cadastro_id',
        'user_ultima_atualizacao',
    ];


    public function telefones()
    {
        return $this->hasMany(PessoaJuridicaTelefone::class);
    }

    public function enderecos()
    {
        return $this->hasMany(PessoaJuridicaEndereco::class);
    }

    public function unidadeDeNegocio()
    {
        return $this->belongsTo(UnidadeDeNegocio::class, 'unidade_de_negocio_id');
    }

    public function pessoaJuridicaContaBancaria()
    {
        return $this->hasMany(PessoaJuridicaContaBancaria::class);
    }

    public function salvarComAtributosMaiusculos(array $atributos)
    {
        foreach ($atributos as $atributo) {
            if (isset($this->$atributo)) {
                $this->$atributo = ucwords(strtolower($this->$atributo));
            }
        }
        $this->save();
    }
}