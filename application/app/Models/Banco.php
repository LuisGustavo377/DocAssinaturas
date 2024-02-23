<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'nome',
        'codigo',
        'status',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',

    ];


//  public function unidadeDeNegocioContaBancaria()
//  {
//      return $this->hasMany(UnidadeDeNegocioContaBancaria::class, 'banco_id');
//  }


 public function contasBancarias()
 {
     return $this->hasMany(UnidadeDeNegocioContaBancaria::class, 'banco_id');
 }



}