@extends('layouts.dashboard')

@section('title', 'Detalhar Licença')

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
                        <form method="POST" action="#">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                    <input type="text" class="form-control" id="nomeGrupoInput" name="numero_contrato"
                                        value="{{ $licenca->grupoDeNegocios->nome }}" disabled>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label id="numeroContratoLabel" class="form-label">Número Contrato</label>
                                        <input type="text" class="form-control" id="numeroContratoInput"
                                            name="numero_contrato" placeholder="Número Contrato"
                                            value="{{ $licenca->numero_contrato }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label id="tipoDeRenovacaoLabel" class="form-label">Tipo de Renovação</label>
                                        <input type="text" class="form-control" id="nomeDeRenovacaoInput"
                                            name="tipo_de_renovacao" value="{{ $licenca->tipoDeRenovacao->descricao }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label id="statusLabel" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="statusInput" name="status"
                                            value="{{ ucfirst($licenca->status) }}" disabled>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label id="inicioLabel" class="form-label">Início</label>
                                        <input type="date" class="form-control" id="inicioInput" name="inicio"
                                            placeholder="Início" value="{{ $licenca->inicio }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label id="terminoLabel" class="form-label">Término</label>
                                        <input type="date" class="form-control" id="terminoInput" name="termino"
                                            placeholder="Término" value="{{ $licenca->termino }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label id="descricaoLabel" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" id="descricaoInput" name="descricao"
                                        placeholder="Descrição" value="{{ $licenca->descricao }}" disabled>
                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                                <div class="mb-3">
                                    <div class="my-4 text-center">
                                        <a href="javascript:history.back()" class="btn btn-light me-2">
                                            <i class="ti ti-arrow-left me-1"></i>
                                            Voltar
                                        </a>
                                        <a href="{{ url('admin/licenca/' . $licenca->id . '/edit') }}"
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
@endsection
