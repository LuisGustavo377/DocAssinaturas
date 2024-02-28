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
                                            value="{{ $unidade->grupo_de_negocio_id }}" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="mb-6 col-md-6">
                                            <label class="form-label">Tipo de Pessoa</label>
                                            <input type="text" class="form-control" id="tipoPessoa" name="tipoPessoa"
                                                value="{{ $unidade->tipo_pessoa === 'pf' ? 'Pessoa Física' : 'Pessoa Jurídica' }}"
                                                disabled>
                                        </div>

                                        <div class="mb-6 col-md-6">
                                            <label class="form-label">Nome/Razão Social</label>
                                            <input type="text" class="form-control" id="nome-razaoSocial"
                                                name="nome-razaoSocial" value="{{ $nome }}" disabled>
                                        </div>

                                    </div>

                                    <!-- Campo Licença -->
                                    <div class="mb-3">
                                        <label id="licencaLabel" class="form-label">Licença</label>
                                        <input type="text" class="form-control" id="licenca_id" name="licenca_id"
                                            value="{{ $unidade->licenca_id }}" disabled>
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
@endsection
