<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeRenovacao extends Model
{
    use HasFactory;

    protected $table = 'tipos_de_renovacao';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

   protected $fillable = [
    'descricao',
];

public function licencas()
{
    return $this->belongsTo(Licenca::class, 'licenca_id');
}



}