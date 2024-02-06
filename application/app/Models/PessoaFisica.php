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
        'senha',
        'senha_temporaria',
        'status',
        'imagem',
        'unidade_negocio_id',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',
        'tipo_de_logradouro_id'
 
    ];


    public function telefones()
    {
        return $this->hasMany(PessoaFisicaTelefone::class);
    }

    public function enderecos()
    {
        return $this->hasMany(PessoaFisicaEndereco::class);
    }

    public function unidadeDeNegocio()
    {
        return $this->belongsTo(UnidadeDeNegocio::class);
    }

    public function pessoaFisicaContaBancaria()
    {
        return $this->hasMany(PessoaFisicaContaBancaria::class);
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