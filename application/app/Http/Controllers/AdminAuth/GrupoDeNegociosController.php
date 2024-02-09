<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\GruposDeNegocioRequest;
use App\Models\GrupoDeNegocios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class GrupoDeNegociosController extends Controller
{
    public function index(): View
    {
        $grupos = GrupoDeNegocios::orderBy('nome')->get();

        return view('admin.grupo-de-negocios.index', compact('grupos'));
    }


    public function create(): View

    {
        return view('admin.grupo-de-negocios.create');
    }

    public function store(GruposDeNegocioRequest $request)
    {

        try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $grupo = new GrupoDeNegocios;

                $grupo->fill($request->all());
                $grupo->id = Str::uuid();
                $grupo->user_cadastro_id = $user_id;
                $grupo->save();


                DB::commit();

                return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo de Negócio criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $grupo = GrupoDeNegocios::findOrFail($id);
        return view('admin.grupo-de-negocios.show', compact('grupo'));
    }

    public function edit($id)
    {
        try {
            $grupo = GrupoDeNegocios::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Grupo não encontrado.');
        }

        return view('admin.grupo-de-negocios.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $grupo = GrupoDeNegocios::findOrFail($id);

            if (!$grupo) {
                throw new \Exception('Grupo não encontrado');
            }

            $grupo->fill($request->all());
            $grupo->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $grupo->save();

            DB::commit();

            return redirect()->route('admin.grupo-de-negocios.index', ['id' => $grupo->id])->with('msg', 'Grupo alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = GrupoDeNegocios::where('nome', 'ILIKE', "%$termoPesquisa%")->get();
        } else {
            $resultados = [];
        }

        return view('admin.grupo-de-negocios.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $grupo = GrupoDeNegocios::findOrFail($id);

        if ($grupo) {
            $grupo->status = 'inativo';
            $grupo->save();

            return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo inativado com sucesso.');
        }

        return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo não encontrado.');
    }

    public function reativar($id)
    {

        $grupo = GrupoDeNegocios::findOrFail($id);

        if ($grupo) {
            $grupo->status = 'ativo';
            $grupo->save();

            return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo reativado com sucesso.');
        }

        return redirect()->route('admin.grupo-de-negocios.index')->with('msg', 'Grupo não encontrado.');
    }
}
