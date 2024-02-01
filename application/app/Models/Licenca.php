<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    use HasFactory;

    protected $table = 'licencas';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'numero_contrato',
        'descricao',
        'inicio',
        'termino',
        'status',
        'tipo_de_renovacao',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',
        'grupos_de_negocio_id',

    ];

    public function grupoDeNegocios()
{
    return $this->belongsTo(GrupoDeNegocios::class, 'grupos_de_negocio_id');
}
}
