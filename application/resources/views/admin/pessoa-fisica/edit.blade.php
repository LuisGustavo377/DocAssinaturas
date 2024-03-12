@extends('layouts.dashboard')

@section('title', 'Alterar Pessoa Física')

@section('sidebar')
    <x-sidebar-admin></x-sidebar-admin>
@endsection

@section('navbar')
    <x-navbar-admin></x-navbar-admin>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pessoa-fisica.update', $pessoa->id) }}"
                            enctype="multipart/form-data">
                            @csrf {{-- Prevenção do Laravel de ataques a formulários --}}
                            @method('PUT')

                            <div class="alert alert-light">
                                <i class="ti ti-user" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label for="nomeInput" class="form-label">Nome Completo </label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                            id="nomeInput" name="nome" placeholder="Nome"
                                            value="{{ old('nome', $pessoa->nome) }}">
                                        @error('nome')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="mb-6 col-md-6">
                                        <label id="cpfLabel" class="form-label">CPF</label>
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                            id="cpfInput" name="cpf" placeholder="CPF" value="{{ old('cpf', $pessoa->cpf) }}"
                                            maxlength="14" oninput="mascaraCPF(this)">
                                        @error('cpf')
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
                                        <label for="telefoneInput" class="form-label">Telefone</label>
                                        <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                            class="form-control telefone @error('telefone') is-invalid @enderror"
                                            id="telefoneInput" name="telefone" placeholder="Telefone"
                                            value="{{ old('telefone', $pessoa->telefones->first()->telefone) }}">
                                        @error('telefone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-6 col-md-6">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="emailInput" name="email" placeholder="Email"
                                            value="{{ old('email', $pessoa->email) }}">
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
                                    <div class="mb-3 col-md-3">
                                        <label for="tipoDeLogradouroSelect" class="form-label">Tipo de Logradouro</label>
                                        <select class="form-select @error('tipo_de_logradouro_id') is-invalid @enderror"
                                            id="tipoDeLogradouroSelect" name="tipo_de_logradouro_id">
                                            <option value="" selected disabled> -- Selecione o tipo de logradouro --
                                            </option>
                                            @foreach ($tiposDeLogradouro as $tipo)
                                                <option value="{{ $tipo->id }}"
                                                    {{ old('tipo_de_logradouro_id', optional($pessoa->enderecos->first())->tipo_de_logradouro_id) == $tipo->id ? 'selected' : '' }}>
                                                    {{ $tipo->descricao }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tipo_de_logradouro_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-9">
                                        <label id="logradouroLabel" class="form-label">Logradouro</label>
                                        <input type="text"
                                            class="form-control  @error('logradouro') is-invalid @enderror"
                                            id="logradouroInput" name="logradouro" placeholder="Logradouro"
                                            value="{{ old('logradouro', $pessoa->enderecos->first()->logradouro) }}">
                                        @error('logradouro')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label id="numeroLabel" class="form-label">Número</label>
                                        <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                            id="numeroInput" name="numero" placeholder="Número"
                                            value="{{ old('numero', $pessoa->enderecos->first()->numero) }}">
                                        @error('numero')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label id="complementoLabel" class="form-label">Complemento</label>
                                        <input type="text"
                                            class="form-control @error('complemento') is-invalid @enderror"
                                            id="complementoInput" name="complemento" placeholder="Complemento"
                                            value="{{ old('complemento', $pessoa->enderecos->first()->complemento) }}">
                                        @error('complemento')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label id="bairroLabel" class="form-label">Bairro</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                            id="bairroInput" name="bairro" placeholder="Bairro"
                                            value="{{ old('bairro', $pessoa->enderecos->first()->bairro) }}">
                                        @error('bairro')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="estadoSelect" class="form-label">Estado</label>
                                        <select class="form-select select2 @error('estado_id') is-invalid @enderror"
                                            id="estadoSelect" name="estado_id">
                                            <option value="" selected disabled> -- Selecione o estado -- </option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}"
                                                    {{ old('estado_id', $pessoa->enderecos->first()->cidade->estado_id) == $estado->id ? 'selected' : '' }}>
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

                                    <div class="mb-3 col-md-6">
                                        <label for="cidadeSelect" class="form-label">Cidade</label>
                                        <select class="form-select select2 @error('cidade_id') is-invalid @enderror"
                                            id="cidadeSelect" name="cidade_id">
                                            <option value="" selected> -- Selecione a cidade -- </option>
                                            @foreach ($cidades as $cidade)
                                                <option value="{{ $cidade->id }}"
                                                    {{ old('cidade_id', $pessoa->enderecos->first()->cidade_id) == $cidade->id ? 'selected' : '' }}>
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
                                <i class="ti ti-photo" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Imagem</label>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <label id="imagemLabel" class="form-label">Nova Imagem</label>
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
                                    <div class="my-4 text-center">
                                        <a href="javascript:history.back()" class="btn btn-light me-2">
                                            <i class="ti ti-arrow-left me-1"></i>
                                            Voltar
                                        </a>
                                        <button type="submit" class="btn btn-success ms-2">
                                            <i class="ti ti-edit me-1"></i>
                                            Alterar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--  Mascara CNPJ -->
                        <script src="{{ asset('assets/js/mascaraCPF.js') }}"></script>

                        <!--  Script para Buscar Cidade dinamicamente de acordo com o Estado -->
                        <script src="{{ asset('assets/js/buscarCidade.js') }}"></script>

                        <!-- Validação Formulario Preenchimento de formulario -->
                        <script src="{{ asset('assets/js/validacaoPreenchimentoFormularioPessoaFisica.js') }}"></script>

                        <!--  Carregar Select2 -->
                        <script src="{{ asset('assets/js/select2.js') }}"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
