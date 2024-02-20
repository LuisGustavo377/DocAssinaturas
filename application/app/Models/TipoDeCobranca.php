<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeCobranca extends Model
{
    use HasFactory;

    protected $table = 'tipos_de_cobranca';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'descricao',
];

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
