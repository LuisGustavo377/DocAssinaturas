<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoDeNegocios extends Model
{
    use HasFactory;

    protected $table = 'grupos_de_negocio';

    //Inicio Configuração UUID
    protected $primaryKey = 'id'; // Nome da coluna UUID
    public $incrementing = false; // Desativar autoincremento
    protected $keyType = 'string'; // Tipo da chave primária
   //Fim Configuração UUID

    protected $fillable = [
        'nome',
        'status',
        'observacao',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',
        'grupo_de_negocio_id',

    ];


    public function licencas()
{
    return $this->hasMany(Licenca::class, 'grupos_de_negocio_id');
}


    // public function unidade()
    // {
    //     return $this->hasMany(UnidadeDeNegocios::class);
    // }
}
