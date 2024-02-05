@extends('layouts.dashboard')

@section('title', 'Detalhar Contrato')

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
                            @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <label id="numero_contratoLabel" class="form-label">Número Contrato</label>
                                    <input type="text"
                                        class="form-control @error('numero_contrato') is-invalid @enderror"
                                        id="numero_contratoInput" name="numero_contrato" placeholder="Número Contrato"
                                        value="{{ $contrato->numero_contrato }}" disabled>
                                    @error('numero_contrato')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label id="statusLabel" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="statusInput" name="status"
                                            value="{{ ucfirst($contrato->status) }}" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label id="arquivoLabel" class="form-label">Contrato</label>
                                        <input type="text" class="form-control" id="arquivoInput" name="arquivo"
                                            value="{{ $contrato->contratoArquivo->first()->arquivo }}" disabled>
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

                                        <a href="{{ url('admin/contrato/' . $contrato->id . '/edit') }}"
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
