<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

    protected $table = 'cargos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária

    protected $fillable = [
        'nome',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
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