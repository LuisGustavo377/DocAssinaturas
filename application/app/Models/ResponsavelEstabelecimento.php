<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponsavelEstabelecimento extends Model
{
    protected $table = 'responsaveis_estabelecimento';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
    //Fim Configuração UUID
    
    protected $fillable = [
        'nome',
        'numero_telefone',
        'cpf',
        'email',
    ];

    // Para UUID como chave primária automaticamente gerado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
        });
    }

     // INICIO ARMAZENANDO NO BANCO COM PRIMEIRAS LETRAS MAIUSCULAS

    public function setNomeAttribute($value)
    {

        $this->attributes['nome'] = ucwords(strtolower($value)); //Armazena com as primeiras letras maiusculas
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value); //Armazena em letra minuscula

        if (empty($value)) { //irá verificar se há string vazia, valores nulos
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }

    // FIM ARMAZENANDO NO BANCO COM PRIMEIRAS LETRAS MAIUSCULAS
}