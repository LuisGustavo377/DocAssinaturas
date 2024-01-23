<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoEstabelecimento extends Model
{
    protected $table = 'enderecos_estabelecimento';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
    //Fim Configuração UUID
    
    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'tipo_endereco',
        'cidade_id',
        'estado_id',

    ];

    // Para UUID como chave primária automaticamente gerado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function setLogradouroAttribute($value)
    {

        $this->attributes['logradouro'] = ucwords(strtolower($value)); //Armazena com as primeiras letras maiusculas
    }

    public function setComplementoAttribute($value)
    {

        $this->attributes['complemento'] = ucwords(strtolower($value)); //Armazena com as primeiras letras maiusculas
    }

    public function setBairroAttribute($value)
    {

        $this->attributes['bairro'] = ucwords(strtolower($value)); //Armazena com as primeiras letras maiusculas
    }

}