<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\ContratoRequest;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CargosController extends Controller
{
    public function index(): View
    {
        $cargos = Cargo::orderBy('descricao')->paginate(20);

        return view('admin.cargos.index', compact('cargos'));
    }

    public function create(): View

    {
        return view('admin.cargos.create');
    }

    public function store(Request $request)
    {
        try {
            if (auth()->check()) {

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $cargo = new Cargo();                
                $cargo->id = Str::uuid();
                $cargo->descricao = $request->descricao;
                $cargo->user_cadastro_id = auth()->id();
                $cargo->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $cargo->save();

                DB::commit();

                return redirect()->route('admin.cargos.index')->with('msg', 'Cargo criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function show($id)
    {
        try {
            $cargo = Cargo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Cargo não encontrado.');
        }
        return view('admin.cargos.show', compact('cargo'));
    }

    public function edit($id)
    {  
        try {
            $cargo = Cargo::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Tipo de Logradouro não encontrado
            abort(404, 'Cargo não encontrado.');
        }
        return view('admin.cargos.edit', compact('cargo'));
    }

    public function update (Request $request, $id)
    {
        try {
            $cargo = Cargo::findOrFail($id);
            if (auth()->check()) {

                DB::beginTransaction();

                $atributosParaMaiusculas = [
                    'descricao', 
                ];  

                // Início - Salvar Plano no Banco
                $cargo->descricao = $request->descricao;
                $cargo->user_ultima_atualizacao_id = auth()->id();
                $cargo->salvarComAtributosMaiusculos($atributosParaMaiusculas);

                $cargo->save();

                DB::commit();

                return redirect()->route('admin.cargos.index')->with('msg', 'Cargo alterado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function inativar($id)
    {

        $cargo = Cargo::findOrFail($id);

        if ($cargo) {
            $cargo->status = 'inativo';
            $cargo->save();

            return redirect()->route('admin.cargos.index')->with('msg', 'Cargo inativado com sucesso.');
        }

        return redirect()->route('admin.cargos.index')->with('msg', 'Cargo não encontrado.');
    }

    public function reativar($id)
    {

        $cargo = Cargo::findOrFail($id);

        if ($cargo) {
            $cargo->status = 'ativo';
            $cargo->save();

            return redirect()->route('admin.cargos.index')->with('msg', 'Cargo reativado com sucesso.');
        }

        return redirect()->route('admin.cargos.index')->with('msg', 'Cargo não encontrado.');
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = Cargo::where('descricao', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.cargos.search', compact('resultados', 'termoPesquisa'));
    }

}