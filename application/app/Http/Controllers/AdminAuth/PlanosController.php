<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\PlanosRequest;
use Illuminate\Http\Request;
use App\Models\Plano;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Termwind\Components\Raw;
use Illuminate\Validation\Rule;

class PlanosController extends Controller
{
    public function index(): View
    {
        $planos = Plano::orderBy('nome')->get();

        return view('admin.planos.index', compact('planos'));
    }


    public function create(): View

    {
        return view('admin.planos.create');
    }

    public function store(PlanosRequest $request)
    {
        try {
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Início - Salvar Plano no Banco
                $plano = new Plano();

                $plano->fill($request->all());
                $plano->id = Str::uuid();
                $plano->status = 'ativo';
                $plano->user_cadastro_id = auth()->id();

                $plano->save();

                DB::commit();

                return redirect()->route('admin.planos.index')->with('msg', 'Plano criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $plano = Plano::findOrFail($id);
        return view('admin.planos.show', compact('plano'));
    }

    public function edit($id)
    {
        try {
            $plano = Plano::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Plano não encontrado
            abort(404, 'Plano não encontrado.');
        }

        return view('admin.planos.edit', compact('plano'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id();
            DB::beginTransaction();

            $plano = Plano::findOrFail($id);

            if (!$plano) {
                throw new \Exception('Plano não encontrado');
            }

            // Validar os campos do formulário
            $request->validate([
                'nome' => ['required', Rule::unique('planos')->ignore($plano->id)],
                'valor' => ['required'],
            ], [
                'nome.required' => 'O campo número do contrato é obrigatório.',
                'valor.required' => 'O campo valor é obrigatório.',
            ]);


            $plano->fill($request->all());
            $plano->user_ultima_atualizacao_id = $user_ultima_atualizacao;

            $plano->save();
            DB::commit();

            return redirect()->route('admin.planos.index', ['id' => $plano->id])->with('msg', 'Plano alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function inativar($id)
    {

        $plano = Plano::findOrFail($id);

        if ($plano) {
            $plano->status = 'inativo';
            $plano->save();

            return redirect()->route('admin.planos.index')->with('msg', 'Plano inativado com sucesso.');
        }

        return redirect()->route('admin.planos.index')->with('msg', 'Plano não encontrado.');
    }

    public function reativar($id)
    {

        $plano = Plano::findOrFail($id);

        if ($plano) {
            $plano->status = 'ativo';
            $plano->save();

            return redirect()->route('admin.planos.index')->with('msg', 'Plano reativado com sucesso.');
        }

        return redirect()->route('admin.planos.index')->with('msg', 'Plano não encontrado.');
    }
}
