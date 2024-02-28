@extends('layouts.dashboard')

@section('title', 'Detalhar Unidade de Negócio')

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
                            <form method="POST" action="#">
                                @csrf {{-- Prevenção do laravel de ataques a formulários --}}
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
                                        <input type="text" class="form-control" id="nomeInput" name="name"
                                            value="{{ $grupo->nome }}" disabled>
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
                                            <label class="form-label">Cpf/Cnpj</label>
                                            <input type="text" class="form-control" id="cpf-cnpj" name="cpf-cnpj"
                                                value="{{ $unidade->cpfOuCnpj }}" disabled>
                                        </div>


                                    </div>

                                    <!-- Campo Licença -->
                                    <div class="mb-3">
                                        <label id="licencaLabel" class="form-label">Licença</label>
                                        <input type="text" class="form-control" id="licenca_id" name="licenca_id"
                                            value="{{ $licenca->descricao }}" disabled>
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
                                            <a href="{{ url('admin/unidade-de-negocio/' . $unidade->id . '/edit') }}"
                                                class="btn btn-success me-2">
                                                <i class="ti ti-edit me-1"></i>
                                                Editar
                                            </a>
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


{{-- Mascara para CPF E CNPJ --}}
    <script>
        $(document).ready(function() {
            $('#cpf-cnpj').on('input', function() {
                var value = $(this).val();
                // Remove a máscara para contar apenas os dígitos
                var digitos = value.replace(/[^\d]/g, '');

                // Determina se é CPF ou CNPJ com base na quantidade de dígitos
                if (digitos.length <= 11) {
                    // Aplica a máscara de CPF
                    $(this).mask('000.000.000-00', {
                        reverse: true
                    });
                } else {
                    // Aplica a máscara de CNPJ
                    $(this).mask('00.000.000/0000-00', {
                        reverse: true
                    });
                }
            });

            // Define a máscara inicialmente com base no tipo de pessoa
            var tipoPessoa = '{{ $unidade->tipo_pessoa }}';
            if (tipoPessoa === 'pf') {
                $('#cpf-cnpj').mask('000.000.000-00', {
                    reverse: true
                });
            } else {
                $('#cpf-cnpj').mask('00.000.000/0000-00', {
                    reverse: true
                });
            }
        });
    </script>


@endsection
