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

class LicencasController extends Controller
{
    public function index(): View
    {
        $unidades = Licenca::orderBy('nome')->get();
              
        return view('admin.licencas.index', compact('unidades'));
    }


    public function create(): View
    
    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get();
        $licenca = Licenca::orderBy('id')->get();
        $pessoaFisica = PessoaFisica::orderBy('nome')->get();
        $pessoaJuridica = PessoaJuridica::orderBy('razao_social')->get();

        $pessoas = $pessoaFisica->merge($pessoaJuridica);

        return view('admin.licencas.create', compact('unidades', 'gruposDeNegocios','pessoas'));
    }

    public function store(Request $request)
    {       
     
       try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $licenca = new Licenca();

                $licenca->id = Str::uuid();
                $licenca->grupo = $request->grupo;
                $licenca->numero_contrato = $request->numero_contrato;
                $licenca->descricao = $request->descricao;
                $licenca->inicio = $request->inicio;
                $licenca->termino = $request->termino;
                $licenca->limite_para_licenciamento = $request->limite_para_licenciamento;
                $licenca->user_cadastro_id = $user_id;    
                $licenca->user_ultima_aualizacao_id = $user_id;    
                $licenca->save();     


                DB::commit();

                return redirect()->route('admin.licencas.index')->with('msg', 'Unidade de Negócio criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    
    public function show($id)
    {
        $licenca = Licenca::findOrFail($id);
        return view('admin.licencas.show', compact('unidade'));
    }

    public function edit($id)
    {
        try {
            $unidade = UnidadeDeNegocio::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Grupo não encontrado.');
        }
    
        return view('admin.licencas.edit', compact('unidade'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $licenca = Licenca::findOrFail($id);

            if (!$licenca) {
                throw new \Exception('Licença não encontrado');
            }

            $licenca->id = $request->input('id');
            $licenca->user_ultima_atualizacao_id = $user_ultima_atualizacao;
            $licenca->save();

            DB::commit();

            return redirect()->route('admin.licencas.index', ['id' => $licenca->id])->with('msg', 'Unidade alterado com sucesso!');
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

        return view('admin.licencas.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $licenca = UnidadeDeNegocio::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'inativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença inativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrado.');
    }

    public function reativar($id)
    {

        $licenca = UnidadeDeNegocio::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'ativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença reativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrado.');
    }
}


