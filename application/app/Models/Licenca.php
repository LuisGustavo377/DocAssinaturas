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
        'tipo_de_renovacao_id',
        'user_cadastro_id',
        'user_ultima_atualizacao_id',
        'grupo_de_negocio_id',
        'contrato_id'

    ];

    public function grupoDeNegocios()
{
    return $this->belongsTo(GrupoDeNegocios::class, 'grupo_de_negocio_id');
}

public function tipoDeRenovacao()
{
    return $this->hasOne(TipoDeRenovacao::class, 'id', 'tipo_de_renovacao_id');
}

public function contrato()
{
    return $this->belongsTo(Contrato::class);
}
public function unidadeDeNegocio()
{
    return $this->belongsTo(UnidadeDeNegocio::class);
}

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
