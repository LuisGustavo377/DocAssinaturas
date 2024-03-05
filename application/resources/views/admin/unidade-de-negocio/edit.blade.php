@extends('layouts.dashboard')

@section('title', 'Alterar Unidade de Negócio')

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
                <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.unidade-de-negocio.update', $unidade->id) }}">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                            @method('PUT')

                            <!-- Seção de Dados Cadastrais -->
                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">
                                <!-- Campo Grupo de Negócio -->
                                <div class="mb-3">
                                    <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                    <select class="form-select @error('grupo_de_negocio_id') is-invalid @enderror"
                                        id="grupoInput" name="grupo_de_negocio_id">
                                        <option value="" disabled> -- Selecione um grupo de negócio -- </option>
                                        @foreach ($gruposDeNegocios as $grupo)
                                        <option value="{{ $grupo->id }}"
                                            {{ $unidade->grupo_de_negocio_id == $grupo->id ? 'selected' : '' }}>
                                            {{ $grupo->nome }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('grupo_de_negocio_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Tipo de Pessoa</label>
                                        <input type="text" class="form-control" id="tipoPessoa" name="tipoPessoa"
                                            value="{{ $unidade->tipo_pessoa === 'pf' ? 'Pessoa Física' : 'Pessoa Jurídica' }}"
                                            disabled>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Nome/Razão Social</label>
                                        <input type="text" class="form-control" id="nome-razaoSocial"
                                            name="nome-razaoSocial" value="{{ $unidade->nomeOuRazaoSocial }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">CPF/CNPJ</label>
                                        <input type="text" class="form-control" id="cpf-cnpj" name="cpf-cnpj"
                                            value="{{ $unidade->cpfOuCnpj }}" disabled>
                                    </div>


                                </div>

                                <!-- Campo Licença -->
                                <div class="mb-3">
                                    <label id="licencaLabel" class="form-label">Licença</label>
                                    <select class="form-select @error('licenca_id') is-invalid @enderror"
                                        id="licencaInput" name="licenca_id">
                                        <option value="" disabled selected> -- Selecione uma licença -- </option>
                                        @if (isset($licencas) && !$licencas->isEmpty())
                                        @foreach ($licencas as $licenca)
                                        <option value="{{ $licenca->id }}"
                                            {{ old('licenca_id') == $licenca->id ? 'selected' : '' }}>
                                            {{ $licenca->descricao }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>

                                    @error('licenca_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Login</label>
                            </div>

                            <div class="card-body">


                                <div class="mb-3">
                                    <label class="form-label">Alterar Senha Temporária</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('senha_temporaria') is-invalid @enderror"
                                            id="senha_temporaria" name="senha_temporaria"
                                            value="{{ old('senha_temporaria') }}"
                                            placeholder="Clique no botão para gerar senha">

                                        <button type="button" class="btn btn-outline-success"
                                            onclick="generateTemporaryPassword()">Gerar Senha</button>
                                        @error('senha_temporaria')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <!-- Seção de Botões -->
                            <div class="mb-3 d-flex justify-content-end">
                                <div class="mb-3">
                                    <div class="my-4 text-center">
                                        <a href="javascript:history.back()" class="btn btn-light me-2">
                                            <i class="ti ti-arrow-left me-1"></i>
                                            Voltar
                                        </a>
                                        <button type="submit" class="btn btn-success ms-2">
                                            <i class="ti ti-check me-1"></i>
                                            Alterar
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


<!-- {{-- Mascara Mostrar CPF/CNPJ --}} -->
<script src="{{ asset('assets/js/mascaraCPFeCnpj.js') }}"></script>


<!-- {{-- Buscar Licenças por grupo --}} -->
<script src="{{ asset('assets/js/buscarLicencaPorGrupoEdit.js') }}"></script>

<!-- {{-- Gerar Senha Temporaria --}} -->
<script src="{{ asset('assets/js/gerarSenhaTemporaria.js') }}"></script>

@endsection