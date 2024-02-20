<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\TipoDeRelacionamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class TipoDeRelacionamentoController extends Controller
{
    public function index(): View
    {
        $tipos_de_relacionamento = TipoDeRelacionamento::orderBy('descricao')->paginate(20);
        

        return view('admin.tipos-de-relacionamento.index', compact('tipos_de_relacionamento'));
    }

}
