@extends ('layouts.dashboard')

@section('title', 'Criar Pessoa Física')

@section('sidebar')
<x-sidebar-admin></x-sidebar-admin>
@endsection

@section('navbar')
<x-navbar-admin></x-navbar-admin>
@endsection

@section('content')

<div class="container-fluid">

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">@yield('title')</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.grupo-de-negocios.store') }}">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <label id="nomeLabel" class="form-label">Nome</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                        id="nomeInput" name="nome" placeholder="Nome" value="{{ old('nome') }}">
                                    @error('nome')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="cpfLabel" class="form-label">CPF</label>
                                    <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                        id="cpfInput" name="cpf" placeholder="CPF" value="{{ old('cpf') }}">
                                    @error('cpf')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="emailLabel" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="emailInput" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Endereço</label>
                                </div>

                                <div class="mb-3">
                                    <label id="tipoLogradouroLabel" class="form-label">Tipo de Logradouro</label>
                                    <select class="form-select @error('tipo_logradouro') is-invalid @enderror"
                                        id="tipoLogradouroInput" name="tipo_logradouro">
                                        <option value="Alameda">Alameda</option>
                                        <option value="Área">Área</option>
                                        <!-- Adicione outras opções aqui -->
                                    </select>
                                    @error('tipo_logradouro')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="logradouroLabel" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control @error('logradouro') is-invalid @enderror"
                                        id="logradouroInput" name="logradouro" placeholder="Logradouro"
                                        value="{{ old('logradouro') }}">
                                    @error('logradouro')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="numeroLabel" class="form-label">Número</label>
                                    <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                        id="numeroInput" name="numero" placeholder="Número" value="{{ old('numero') }}">
                                    @error('numero')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="complementoLabel" class="form-label">Complemento</label>
                                    <input type="text" class="form-control @error('complemento') is-invalid @enderror"
                                        id="complementoInput" name="complemento" placeholder="Complemento"
                                        value="{{ old('complemento') }}">
                                    @error('complemento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="bairroLabel" class="form-label">Bairro</label>
                                    <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                        id="bairroInput" name="bairro" placeholder="Bairro" value="{{ old('bairro') }}">
                                    @error('bairro')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="estadoIdLabel" class="form-label">Estado</label>
                                    <input type="text" class="form-control @error('estado_id') is-invalid @enderror"
                                        id="estadoIdInput" name="estado_id" placeholder="Estado ID"
                                        value="{{ old('estado_id') }}">
                                    @error('estado_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="cidadeIdLabel" class="form-label">Cidade</label>
                                    <input type="text" class="form-control @error('cidade_id') is-invalid @enderror"
                                        id="cidadeIdInput" name="cidade_id" placeholder="Cidade ID"
                                        value="{{ old('cidade_id') }}">
                                    @error('cidade_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label id="imagemLabel" class="form-label">Imagem</label>
                                    <input type="file" class="form-control @error('imagem') is-invalid @enderror"
                                        id="imagemInput" name="imagem">
                                    @error('imagem')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Documentos</label>
                                </div>

                                <div class="mb-3">
                                    <label id="rgLabel" class="form-label">RG</label>
                                    <input type="text" class="form-control @error('rg') is-invalid @enderror"
                                        id="rgInput" name="rg" placeholder="RG" value="{{ old('rg') }}">
                                    @error('rg')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="dataNascimentoLabel" class="form-label">Data de Nascimento</label>
                                    <input type="date"
                                        class="form-control @error('data_de_nascimento') is-invalid @enderror"
                                        id="dataNascimentoInput" name="data_de_nascimento"
                                        value="{{ old('data_de_nascimento') }}">
                                    @error('data_de_nascimento')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="estadoCivilLabel" class="form-label">Estado Civil</label>
                                    <select class="form-select @error('estado_civil') is-invalid @enderror"
                                        id="estadoCivilInput" name="estado_civil">
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <!-- Adicione outras opções aqui -->
                                    </select>
                                    @error('estado_civil')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="nacionalidadeLabel" class="form-label">Nacionalidade</label>
                                    <input type="text" class="form-control @error('nacionalidade') is-invalid @enderror"
                                        id="nacionalidadeInput" name="nacionalidade" placeholder="Nacionalidade"
                                        value="{{ old('nacionalidade') }}">
                                    @error('nacionalidade')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="nomeMaeLabel" class="form-label">Nome da Mãe</label>
                                    <input type="text" class="form-control @error('nome_da_mae') is-invalid @enderror"
                                        id="nomeMaeInput" name="nome_da_mae" placeholder="Nome da Mãe"
                                        value="{{ old('nome_da_mae') }}">
                                    @error('nome_da_mae')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="nomePaiLabel" class="form-label">Nome do Pai</label>
                                    <input type="text" class="form-control @error('nome_do_pai') is-invalid @enderror"
                                        id="nomePaiInput" name="nome_do_pai" placeholder="Nome do Pai"
                                        value="{{ old('nome_do_pai') }}">
                                    @error('nome_do_pai')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="tituloEleitorLabel" class="form-label">Título de Eleitor</label>
                                    <input type="text"
                                        class="form-control @error('titulo_de_eleitor') is-invalid @enderror"
                                        id="tituloEleitorInput" name="titulo_de_eleitor" placeholder="Título de Eleitor"
                                        value="{{ old('titulo_de_eleitor') }}">
                                    @error('titulo_de_eleitor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="pisPasepLabel" class="form-label">Número PIS/PASEP</label>
                                    <input type="text"
                                        class="form-control @error('numero_pis_pasep') is-invalid @enderror"
                                        id="pisPasepInput" name="numero_pis_pasep" placeholder="Número PIS/PASEP"
                                        value="{{ old('numero_pis_pasep') }}">
                                    @error('numero_pis_pasep')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="escolaridadeLabel" class="form-label">Escolaridade</label>
                                    <input type="text" class="form-control @error('escolaridade') is-invalid @enderror"
                                        id="escolaridadeInput" name="escolaridade" placeholder="Escolaridade"
                                        value="{{ old('escolaridade') }}">
                                    @error('escolaridade')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="cargoLabel" class="form-label">Cargo</label>
                                    <input type="text" class="form-control @error('cargo') is-invalid @enderror"
                                        id="cargoInput" name="cargo" placeholder="Cargo" value="{{ old('cargo') }}">
                                    @error('cargo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>




                            <div class="mb-3 d-flex justify-content-end">
                                <div class="mb-3">
                                    <div class="text-center my-4">
                                        <a href="javascript:history.back()" class="btn btn-light me-2">
                                            <i class="ti ti-arrow-left me-1"></i>
                                            Voltar
                                        </a>
                                        <button type="submit" class="btn btn-success ms-2">
                                            <i class="ti ti-plus me-1"></i>
                                            Cadastrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection