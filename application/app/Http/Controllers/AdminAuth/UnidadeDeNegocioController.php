<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use App\Models\Licenca;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UnidadeDeNegocioController extends Controller
{
    public function index(): View
    {
        $unidades = UnidadeDeNegocio::orderBy('id')->get();
        $grupos = GrupoDeNegocios::orderBy('id')->get();

        return view('admin.unidade-de-negocio.index', compact('unidades', 'grupos'));
    }


    public function create(): View
    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get();
        $licenca = Licenca::orderBy('id')->get();
        $pessoaF = PessoaFisica::all();

        return view('admin.unidade-de-negocio.create', compact('unidades', 'gruposDeNegocios', 'pessoaF'));
    }



    public function store(Request $request)
    {

        try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $unidade = new UnidadeDeNegocio();
                $unidade->fill($request->all());
                $unidade->id = Str::uuid();
                $unidade->user_cadastro_id = $user_id;
                $unidade->save();


                DB::commit();

                return redirect()->route('admin.unidade-de-negocios.index')->with('msg', 'Unidade de Negócio criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $unidade = UnidadeDeNegocio::findOrFail($id);
        return view('admin.unidade-de-negocio.show', compact('unidade'));
    }

    public function edit($id)
    {
        try {
            $unidade = UnidadeDeNegocio::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Grupo não encontrado.');
        }

        return view('admin.unidade-de-negocio.edit', compact('unidade'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $unidade = UnidadeDeNegocio::findOrFail($id);

            if (!$unidade) {
                throw new \Exception('Unidade não encontrado');
            }

            $unidade->nome = $request->input('name');
            $unidade->observacao = $request->input('observacao');
            $unidade->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $unidade->save();

            DB::commit();

            return redirect()->route('admin.unidade-de-negocio.index', ['id' => $unidade->id])->with('msg', 'Unidade alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = UnidadeDeNegocio::where('nome', 'ILIKE', "%$termoPesquisa%")->get();
        } else {
            $resultados = [];
        }

        return view('admin.unidade-de-negocio.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'inativo';
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade inativado com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade não encontrado.');
    }

    public function reativar($id)
    {

        $unidade = UnidadeDeNegocio::findOrFail($id);

        if ($unidade) {
            $unidade->status = 'ativo';
            $unidade->save();

            return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade reativada com sucesso.');
        }

        return redirect()->route('admin.unidade-de-negocio.index')->with('msg', 'Unidade não encontrado.');
    }


}
