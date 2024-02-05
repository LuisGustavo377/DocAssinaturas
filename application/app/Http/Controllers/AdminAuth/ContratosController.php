<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\ContratoArquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ContratosController extends Controller
{
    public function index(): View
    {
        $contratos = Contrato::orderBy('numero_contrato')->get();

        return view('admin.contratos.index', compact('contratos'));
    }


    public function create(): View

    {
        return view('admin.contratos.create');
    }

    public function store(Request $request)
    {
        try {
            if (auth()->check()) {
                $user_id = auth()->id(); // Recupera o ID do usuário da sessão

                DB::beginTransaction();

                // Início - Salvar Contrato no Banco
                $contrato = new Contrato();

                $contrato->fill($request->all());
                $contrato->status = 'ativo';
                $contrato->id = Str::uuid();

                // Verificar se o arquivo é válido antes de tentar armazenar
                if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                    // Validar tipo de arquivo e tamanho
                    $request->validate([
                        'arquivo' => 'file|mimes:pdf|max:20480',
                    ]);

                    // Gerar um nome de arquivo único
                    $nameFile = $this->generateUniqueFileName($request->name, $request->file('arquivo')->extension());

                    // Salvar o arquivo no disco 'contratos'
                    $path = $request->file('arquivo')->storeAs('contratos', $nameFile);

                    // // Salvar o nome do arquivo no banco de dados
                    // $contrato->arquivo = $nameFile;
                } else {
                    // Adicione uma lógica para lidar com o arquivo não sendo válido
                    return redirect()->back()->withErrors(['arquivo' => 'O arquivo não é válido.']);
                }

                $contrato->save();
                // Fim - Salvar Contrato no Banco

                // -- Início -- Salvar arquivos na tabela ContratosArquivos --

                $arquivo_contrato = new ContratoArquivo();

                $arquivo_contrato->id = Str::uuid();
                $arquivo_contrato->numero_contrato = $contrato->numero_contrato; // Substitua pelo campo correto
                $arquivo_contrato->arquivo = $nameFile;
                $arquivo_contrato->contrato_id = $contrato->id;
                $arquivo_contrato->user_cadastro_id = Auth::id();
                $arquivo_contrato->user_ultima_atualizacao_id = Auth::id();

                $arquivo_contrato->save();

                // -- Fim -- Salvar arquivos na tabela ContratosArquivos --

                DB::commit();

                return redirect()->route('admin.contratos.index')->with('msg', 'Contrato criado com sucesso!');
            }
        } catch (\Exception $e) {
            // Em caso de erro, reverta a transação e lance a exceção novamente.
            DB::rollback();
            throw $e;
        }
    }





    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        return view('admin.contratos.show', compact('contrato'));
    }

    public function edit($id)
    {
        try {
            $contrato = Contrato::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Tratamento de exceção: Grupo não encontrado
            abort(404, 'Contrato não encontrado.');
        }

        return view('admin.contratos.edit', compact('contrato'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user_ultima_atualizacao = auth()->id(); // Recupera o ID do usuário da sessão
            DB::beginTransaction();

            $contrato = Contrato::findOrFail($id);

            if (!$contrato) {
                throw new \Exception('Contrato não encontrado');
            }

            $contrato->fill($request->all());
            $contrato->status = 'ativo';
            $contrato->id = Str::uuid();

            // Verificar se o arquivo é válido antes de tentar armazenar
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                // Validar tipo de arquivo e tamanho
                $request->validate([
                    'arquivo' => 'file|mimes:pdf|max:20480',
                ]);

                // Gerar um nome de arquivo único
                $nameFile = $this->generateUniqueFileName($request->name, $request->file('arquivo')->extension());

                // Salvar o arquivo no disco 'contratos'
                $path = $request->file('arquivo')->store($nameFile, 'contratos');

                // Salvar o nome do arquivo no banco de dados
                $contrato->arquivo = $nameFile;
            } else {
                // Adicione uma lógica para lidar com o arquivo não sendo válido
                return redirect()->back()->withErrors(['arquivo' => 'O arquivo não é válido.']);
            }

            $contrato->save();

            DB::commit();

            return redirect()->route('admin.contratos.index', ['id' => $contrato->id])->with('msg', 'Contrato alterado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $termoPesquisa = $request->input('search');

        if (Auth::check()) {
            $resultados = Contrato::where('nome', 'ILIKE', "%$termoPesquisa%")->get();
        } else {
            $resultados = [];
        }

        return view('admin.contratos.search', compact('resultados', 'termoPesquisa'));
    }

    public function inativar($id)
    {

        $contrato = Contrato::findOrFail($id);

        if ($contrato) {
            $contrato->status = 'inativo';
            $contrato->save();

            return redirect()->route('admin.contratos.index')->with('msg', 'Contrato inativado com sucesso.');
        }

        return redirect()->route('admin.contratos.index')->with('msg', 'Contrato não encontrado.');
    }

    public function reativar($id)
    {

        $contrato = Contrato::findOrFail($id);

        if ($contrato) {
            $contrato->status = 'ativo';
            $contrato->save();

            return redirect()->route('admin.contratos.index')->with('msg', 'Contrato reativado com sucesso.');
        }

        return redirect()->route('admin.contratos.index')->with('msg', 'Contrato não encontrado.');
    }

    private function generateUniqueFileName($baseName, $extension)
    {
        $counter = 1;
        $uniqueName = $baseName . '_' . $counter . '.' . $extension;

        // Verificar se o nome do arquivo já existe
        while (Storage::exists('contratos/' . $uniqueName)) {
            $counter++;
            $uniqueName = $baseName . '_' . $counter . '.' . $extension;
        }

        return $uniqueName;
    }
}
