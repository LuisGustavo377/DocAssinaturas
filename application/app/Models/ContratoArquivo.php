<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoArquivo extends Model
{
    use HasFactory;

    protected $table = 'contratos_arquivos';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'numero_contrato',
        'arquivo',
        'contrato_id',
        'user_cadastro_id',
        'user_ultima_atualizacao_id'

    ];

   
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
