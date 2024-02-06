<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisicaEndereco extends Model
{
    use HasFactory;

    protected $table = 'pessoa_fisica_enderecos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID


    protected $fillable = [
        'tipo_de_logradouro_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado_id',
        'cidade_id',
        'pessoa_fisica_id',
        'user_cadastro_id',
        'user_ultima_atualizacao_id'
    ];


    public function pessoa()
    {
        return $this->belongsTo(PessoaFisica::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }


    public function tipoDeLogradouro()
    {
        return $this->belongsTo(TipoDeLogradouro::class, 'tipo_de_logradouro_id');
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