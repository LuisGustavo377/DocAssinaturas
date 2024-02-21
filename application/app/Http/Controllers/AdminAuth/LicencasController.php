<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\LicencaRequest as AdminAuthLicencaRequest;
use App\Http\Requests\LicencaRequest;
use App\Models\Contrato;
use App\Models\GrupoDeNegocios;
use App\Models\UnidadeDeNegocio;
use App\Models\Licenca;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\Models\TipoDeRenovacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Termwind\Components\Dd;

class LicencasController extends Controller
{
    public function index(): View
    {

        $usuario = Auth::check();

        $licencas = Licenca::all();
        $grupos = GrupoDeNegocios::all();

        return view('admin.licencas.index', compact('licencas', 'grupos'));
    }


    public function create(): View

    {
        $gruposDeNegocios = GrupoDeNegocios::orderBy('nome')->get();
        $unidades = UnidadeDeNegocio::orderBy('id')->get(); // talvez ainda nem precise 
        $licencas = Licenca::orderBy('id')->get();
        $tiposDeRenovacao = TipoDeRenovacao::all();
        $contratos = Contrato::all();

        // $pessoas = $gruposDeNegocios->merge($unidades); utilizar na unidade de negócio

        return view('admin.licencas.create', compact('unidades', 'gruposDeNegocios', 'licencas', 'tiposDeRenovacao', 'contratos'));
    }

    public function store(AdminAuthLicencaRequest $request)
    {
        
        try {

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Inicio - Salvar Grupo no Banco

                $licenca = new Licenca();

                $licenca->fill($request->all());
                $licenca->id = Str::uuid();
                $licenca->status = 'ativo';
                $licenca->tipo_de_renovacao_id = $request->tipo_de_renovacao;
                $licenca->user_cadastro_id = auth()->id();
                $licenca->save();

                DB::commit();

                return redirect()->route('admin.licencas.index')->with('msg', 'Licença criada com sucesso!');
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
        return view('admin.licencas.show', compact('licenca'));
    }

    public function edit($id)
    {
        try {
            $licenca = Licenca::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Licença não encontrada.');
        }

        return view('admin.licencas.edit', compact('licenca'));
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

            $licenca->fill($request->all());
            $licenca->user_ultima_atualizacao_id = auth()->id();
            $licenca->save();

            DB::commit();

            return redirect()->route('admin.licencas.index', ['id' => $licenca->id])->with('msg', 'Licença alterada com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');
        $licenca = Licenca::all();

        if (Auth::check()) {
            $resultados = Licenca::with('grupoDeNegocios')
                ->whereHas('grupoDeNegocios', function ($query) use ($termoPesquisa) {
                    $query->where('nome', 'ILIKE', "%$termoPesquisa%");
                })
                ->get();
        } else {
            $resultados = [];
        }

        return view('admin.licencas.search', compact('resultados', 'termoPesquisa', 'licenca'));
    }

    public function inativar($id)
    {

        $licenca = Licenca::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'inativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença inativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrada.');
    }

    public function reativar($id)
    {

        $licenca = Licenca::findOrFail($id);

        if ($licenca) {
            $licenca->status = 'ativo';
            $licenca->save();

            return redirect()->route('admin.licencas.index')->with('msg', 'Licença reativada com sucesso.');
        }

        return redirect()->route('admin.licencas.index')->with('msg', 'Licença não encontrada.');
    }

    public function licencasPorGrupo(Request $request)
    {
        $grupo_de_negocio_id = $request->grupo_de_negocio_id;
        $licencas = Licenca::where('grupo_de_negocio_id', $grupo_de_negocio_id)->get();
        return response()->json($licencas);
    }
    
}
