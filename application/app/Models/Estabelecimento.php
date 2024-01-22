<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    use HasFactory;

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'regime',
        'nome',
        'cpf',
        'cnpj',
        'telefone',
        'email',
        'senha',
        'logotipo',
        'status',
    ];

    // Para UUID como chave primária automaticamente gerado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
        });
    }

    protected $casts = [
       'senha' => 'hashed',
    ];

    // INICIO DEFININDO RELACOES COM CHAVES ESTRANGEIRAS

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    
    public function responsavel()
    {
        return $this->belongsTo(ResponsavelEstabelecimento::class);
    }

    public function endereco()
    {
        return $this->hasOne(EnderecosEstabelecimento::class);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

 
    public function contasEstabelecimento()
    {
        return $this->hasMany(ContasEstabelecimento::class);
    }

    // FIM DEFININDO RELACOES COM CHAVES ESTRANGEIRAS

     // INICIO ARMAZENANDO NO BANCO COM PRIMEIRAS LETRAS MAIUSCULAS

    public function setNomeAttribute($value)
    {

        $this->attributes['nome'] = ucwords(strtolower($value)); //Armazena com as primeiras letras maiusculas
    }

    // FIM ARMAZENANDO NO BANCO COM PRIMEIRAS LETRAS MAIUSCULAS

 
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value); //Armazena em letra minuscula

        if (empty($value)) { //irá verificar se há string vazia, valores nulos
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }


 


}