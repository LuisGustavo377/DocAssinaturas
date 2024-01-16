<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'abreviacao',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get all of the cities for the state.
     */
    public function cidades()
    {

        return $this->hasMany(Cidade::class);

    }


    public function create()
    {
        $estados = Estado::all(); // Recupere os estados do banco de dados (ou de outra fonte de dados)

        return view('create', compact('estados'));
    }


}