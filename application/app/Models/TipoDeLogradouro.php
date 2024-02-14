<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeLogradouro extends Model
{
    use HasFactory;

    protected $table = 'tipos_de_logradouro';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'descricao',
   ];


   public function enderecos()
{
    return $this->hasMany(PessoaFisicaEndereco::class, 'tipo_de_logradouro_id');
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