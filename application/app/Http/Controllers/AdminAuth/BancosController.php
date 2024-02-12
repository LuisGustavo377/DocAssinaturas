<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuth\BancosRequest;
use Illuminate\Http\Request;
use App\Models\Banco;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Termwind\Components\Raw;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BancosController extends Controller
{
    public function index(): View
    {
        $bancos = Banco::orderBy('nome', 'asc')->get();

        return view('admin.bancos.index', compact('bancos'));
    }


    public function create(): View

    {
        return view('admin.bancos.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'codigo' => 'required|string|max:3|unique:bancos',
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string' => 'O campo nome deve ser uma string.',
                'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
                'codigo.required' => 'O campo código é obrigatório.',
                'codigo.string' => 'O campo código deve ser uma string.',
                'codigo.max' => 'O campo código não pode ter mais de 3 dígitos.',
                'codigo.unique' => 'O código informado já está em uso.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Início - Salvar Banco no Banco
                $banco = new Banco();

                $banco->id = Str::uuid();
                $banco->nome = $request->nome;
                $banco->codigo = $request->codigo;
                $banco->status = 'ativo';
                $banco->user_cadastro_id = auth()->id();

                $banco->save();

                DB::commit();

                return redirect()->route('admin.bancos.index')->with('msg', 'Banco criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }


    public function show($id)
    {
        $banco = Banco::findOrFail($id);
        return view('admin.bancos.show', compact('banco'));
    }

    public function edit($id)
    {
        try {
            $banco = Banco::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Banco não encontrado
            abort(404, 'Banco não encontrado.');
        }

        return view('admin.bancos.edit', compact('banco'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validação dos campos do formulário
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'codigo' => [
                    'required',
                    'string',
                    'max:3',
                    Rule::unique('bancos')->ignore($id),
                ],
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string' => 'O campo nome deve ser uma string.',
                'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
                'codigo.required' => 'O campo código é obrigatório.',
                'codigo.string' => 'O campo código deve ser uma string.',
                'codigo.max' => 'O campo código não pode ter mais de 3 dígitos.',
                'codigo.unique' => 'O código informado já está em uso.',
            ]);
    
            // Se a validação falhar, redirecione de volta ao formulário com os erros
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            DB::beginTransaction();
    
            $banco = Banco::findOrFail($id);
    
            if (!$banco) {
                throw new \Exception('Banco não encontrado');
            }
    
            // Atualiza os campos do banco
            $banco->nome = $request->nome;
            $banco->codigo = $request->codigo;
            $banco->user_ultima_atualizacao_id = auth()->id();
    
            $banco->save();
            DB::commit();
    
            return redirect()->route('admin.bancos.index', ['id' => $banco->id])->with('msg', 'Banco alterado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }

    public function inativar($id)
    {

        $banco = Banco::findOrFail($id);

        if ($banco) {
            $banco->status = 'inativo';
            $banco->save();

            return redirect()->route('admin.bancos.index')->with('msg', 'Banco inativado com sucesso.');
        }

        return redirect()->route('admin.bancos.index')->with('msg', 'Banco não encontrado.');
    }

    public function reativar($id)
    {

        $banco = Banco::findOrFail($id);

        if ($banco) {
            $banco->status = 'ativo';
            $banco->save();

            return redirect()->route('admin.bancos.index')->with('msg', 'Bancos reativado com sucesso.');
        }

        return redirect()->route('admin.bancos.index')->with('msg', 'Banco não encontrado.');
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = Banco::where('nome', 'ILIKE', "%$termoPesquisa%")
            ->orWhere('codigo', 'ILIKE', "%$termoPesquisa%")
            ->get();
        } else {
            $resultados = [];
        }

        return view('admin.bancos.search', compact('resultados', 'termoPesquisa'));
    }

}