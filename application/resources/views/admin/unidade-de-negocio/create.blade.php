@extends ('layouts.dashboard')

@section('title', 'Unidade de Negócios')

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
                            <form method="POST" action="{{ route('admin.unidade-de-negocio.store') }}">
                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados de Vinculação</label>
                                </div>

                                <div class="card-body">

                                    <div class="mb-3">
                                        <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                        <select class="form-select @error('grupo_de_negocio_id') is-invalid @enderror"
                                            id="grupoInput" name="grupo_de_negocio_id">
                                            <option value="" disabled selected> -- Selecione um grupo de negócio --
                                            </option>
                                            @foreach ($gruposDeNegocios as $grupo)
                                                <option value="{{ $grupo->id }}"
                                                    {{ old('grupo_de_negocio_id') == $grupo->id ? 'selected' : '' }}>
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

                                    <div class="mb-3">
                                        <label class="form-label">Tipo de Pessoa</label>
                                        <select id="tipoPessoaSelect"
                                            class="form-select @error('tipoPessoaInput') is-invalid @enderror">
                                            <option value="" {{ old('tipoPessoaInput') == '' ? 'selected' : '' }}
                                                disabled> -- Selecione o tipo de pessoa -- </option>
                                            <option value="PF" {{ old('tipoPessoaInput') == 'PF' ? 'selected' : '' }}>
                                                Pessoa Física</option>
                                            <option value="PJ" {{ old('tipoPessoaInput') == 'PJ' ? 'selected' : '' }}>
                                                Pessoa Jurídica</option>
                                        </select>
                                        <input type="hidden" id="tipoPessoaInput" name="tipoPessoaInput"
                                            value="{{ old('tipoPessoaInput') }}">
                                        @error('tipoPessoaInput')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                     <div class="mb-3" id="cpfInputDiv" @if(old('tipoPessoaInput') == 'pf') style="display: block;" @else style="display: none;" @endif>
                                        <label class="form-label">Pesquisar por CPF</label>
                                        <input type="text" class="form-control" id="cpfInput" name="cpfInput"
                                            maxlength="11" value="{{ old('cpfInput') }}">
                                        <div id="pessoaFisicaResult"></div>
                                        <input type="hidden" id="cpfIdInput" name="cpfIdInput">
                                    </div>

                                    <div class="mb-3" id="cnpjInputDiv" @if(old('tipoPessoaInput') == 'pj') style="display: block;" @else style="display: none;" @endif>
                                        <label class="form-label">Pesquisar por CNPJ</label>
                                        <input type="text" class="form-control" id="cnpjInput" name="cnpjInput"
                                            maxlength="14"  value="{{ old('cnpjInput') }}">
                                        <div id="pessoaJuridicaResult"></div>
                                        <input type="hidden" id="razaoSocialIdInput" name="razaoSocialIdInput">
                                    </div>



                                    <div class="mb-3">
                                        <label id="licencaLabel" class="form-label">Licença</label>
                                        <select class="form-select @error('licenca_id') is-invalid @enderror"
                                            id="licencaInput" name="licenca_id">
                                            <option value="" disabled selected> -- Selecione uma licença -- </option>
                                            <!-- Opções de licença serão preenchidas dinamicamente pelo JavaScript -->
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
                                        <label class="form-label">Senha Temporária</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('senha_temporaria') is-invalid @enderror"
                                                id="senha_temporaria" name="senha_temporaria"
                                                value="{{ old('senha_temporaria') }}"
                                                placeholder="Clique no botão para gerar senha" readonly>

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



                                <div class="mb-3 d-flex justify-content-end">
                                    <div class="mb-3">
                                        <div class="my-4 text-center">
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

    <!-- Inicio Gerar Senha Temporaria -->

    <script>
        function generateTemporaryPassword() {
            const temporaryPasswordInput = document.getElementById('senha_temporaria');
            const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
            temporaryPasswordInput.value = temporaryPassword;
        }
    </script>
    <!-- Fim Gerar Senha Temporaria -->


    {{-- Buscar Licenças por grupo --}}
    <script src="{{ asset('assets/js/buscarLicencaPorGrupo.js') }}"></script>

    <!-- Script para Buscar Pessoa-->
    <script src="{{ asset('assets/js/buscarPessoaFisica.js') }}"></script>
    <script src="{{ asset('assets/js/buscarPessoaJuridica.js') }}"></script>
    <script src="{{ asset('assets/js/mostrarPessoas.js') }}"></script>

    <!--  Mascara CNPJ -->
    <script src="{{ asset('assets/js/mascaraCNPJ.js') }}"></script>
    <script src="{{ asset('assets/js/mascaraCPF.js') }}"></script>

    <script src="{{ asset('assets/js/inputPjPf.js') }}"></script>


@endsection
