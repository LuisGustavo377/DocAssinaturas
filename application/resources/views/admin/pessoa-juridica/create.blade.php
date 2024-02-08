@extends ('layouts.dashboard')

@section('title', 'Criar Pessoa Jurídica')

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
                        <form method="POST" action="{{ route('admin.pessoa-juridica.store') }}"
                            enctype="multipart/form-data">
                            @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                            <div class="alert alert-light">
                                <i class="ti ti-user" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label id="razaoSocialLabel" class="form-label">Razão Social</label>
                                        <input type="text"
                                            class="form-control @error('razao_social') is-invalid @enderror"
                                            id="razaoSocialInput" name="razao_social" placeholder="Razão Social"
                                            value="{{ old('razao_social') }}">
                                        @error('razao_social')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-6 col-md-6">
                                        <label id="nomeFantasiaLabel" class="form-label">Nome Fantasia</label>
                                        <input type="text"
                                            class="form-control @error('nome_fantasia') is-invalid @enderror"
                                            id="nomeFantasiaInput" name="nome_fantasia" placeholder="Nome Fantasia"
                                            value="{{ old('nome_fantasia') }}">
                                        @error('nome_fantasia')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label id="cnpjLabel" class="form-label">CNPJ</label>
                                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror"
                                            id="cnpjInput" name="cnpj" placeholder="CNPJ" value="{{ old('cnpj') }}"
                                            maxlength="14">
                                        @error('cnpj')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Inscrição Estadual</label>
                                        <input type="tel"
                                            class="form-control telefone @error('inscricao_estadual') is-invalid @enderror"
                                            id="inscricaoEstadualInput" name="inscricao_estadual"
                                            placeholder="Inscrição Estadual" value="{{ old('inscricao_estadual') }}">
                                        @error('inscricao_estadual')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Inscrição Municipal</label>
                                        <input type="tel"
                                            class="form-control telefone @error('inscricao_municipal') is-invalid @enderror"
                                            id="inscricaoMunicipalInput" name="inscricao_municipal"
                                            placeholder="Inscrição Municipal" value="{{ old('inscricao_municipal') }}">
                                        @error('inscricao_municipal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light">
                                <i class="ti ti-message" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Contato</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label class="form-label">Telefone</label>
                                        <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                            class="form-control telefone @error('telefone') is-invalid @enderror"
                                            id="telefoneInput" name="telefone" placeholder="Telefone"
                                            value="{{ old('telefone') }}">
                                        @error('telefone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-6 col-md-6">
                                        <label id="emailLabel" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="emailInput" name="email" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <div class="alert alert-light">
                                <i class="ti ti-address-book" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Endereço</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Tipo de Logradouro</label>
                                        <select class="form-select @error('tipo_de_logradouro_id') is-invalid @enderror"
                                            id="tipoLogradouroInput" name="tipo_de_logradouro_id">
                                            <option value="" selected disabled> -- Selecione o tipo de logradouro --
                                            </option>
                                            @foreach($tipos_de_logradouro as $tipo)
                                            <option value="{{ $tipo['id'] }}"
                                                {{ old('tipo_de_logradouro_id') == $tipo['id'] ? 'selected' : '' }}>
                                                {{ $tipo['descricao'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('tipo_de_logradouro_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-9 mb-3">
                                        <label id="logradouroLabel" class="form-label">Logradouro</label>
                                        <input type="text"
                                            class="form-control @error('logradouro') is-invalid @enderror"
                                            id="logradouroInput" name="logradouro" placeholder="Logradouro"
                                            value="{{ old('logradouro') }}">
                                        @error('logradouro')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label id="numeroLabel" class="form-label">Número</label>
                                        <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                            id="numeroInput" name="numero" placeholder="Número"
                                            value="{{ old('numero') }}">
                                        @error('numero')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label id="complementoLabel" class="form-label">Complemento</label>
                                        <input type="text"
                                            class="form-control @error('complemento') is-invalid @enderror"
                                            id="complementoInput" name="complemento" placeholder="Complemento"
                                            value="{{ old('complemento') }}">
                                        @error('complemento')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label id="bairroLabel" class="form-label">Bairro</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                            id="bairroInput" name="bairro" placeholder="Bairro"
                                            value="{{ old('bairro') }}">
                                        @error('bairro')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="estadoSelect" class="form-label">Estado</label>
                                        <select class="form-select @error('estado_id') is-invalid @enderror"
                                            id="estadoSelect" name="estado_id">
                                            <option value="" selected disabled> -- Selecione o estado -- </option>
                                            @foreach($estados as $estado)
                                            <option value="{{ $estado->id }}"
                                                {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                                                {{ $estado->nome }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('estado_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="cidadeSelect" class="form-label">Cidade</label>
                                        <select class="form-select @error('cidade_id') is-invalid @enderror"
                                            id="cidadeSelect" name="cidade_id">
                                            <option value="" selected disabled> -- Selecione a cidade -- </option>
                                            @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->id }}"
                                                {{ old('cidade_id') == $cidade->id ? 'selected' : '' }}>
                                                {{ $cidade->nome }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('cidade_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light">
                                <i class="ti ti-image" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Imagem</label>
                            </div>

                            <div class="card-body">
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

                    <!--  Mascara CNPJ -->
                    <script src="{{ asset('assets/js/mascaraCNPJ.js') }}"></script>

                    <!--  Script para Buscar Cidade dinamicamente de acordo com o Estado -->
                    <script src="{{ asset('assets/js/buscarCidade.js') }}"></script>
                    
                    <!-- Validação Formulario Preenchimento de formulario -->
                    <script src="{{ asset('assets/js/validacaoPreenchimentoFormularioPessoaJuridica.js') }}"></script>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection