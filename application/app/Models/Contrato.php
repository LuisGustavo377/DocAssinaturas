<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'numero_contrato',
        'status',
        'plano_id'

    ];

    public function contratoArquivo()
    {
        return $this->hasMany(ContratoArquivo::class);
    }

    public function licenca()
    {
        return $this->hasMany(Licenca::class);
    }

    public function planos()
    {
        return $this->belongsTo(Plano::class, 'plano_id');
    }
}
