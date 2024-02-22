@extends('layouts.dashboard')

@section('title', 'Detalhar Grupo de Negócios')

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
                                <div class="row">
                                <div class="mb-3 col-md-6">
                                        <label id="nomeLabel" class="form-label">Nome</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="nomeInput" name="name" placeholder="Nome" value="{{ $grupo->nome }}"
                                            disabled>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label id="statusLabel" class="form-label">Status</label>
                                        <input type="text" class="form-control @error('status') is-invalid @enderror"
                                            id="statusInput" name="status" value="{{ ucfirst($grupo->status) }}"
                                            disabled>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label id="observacaoLabel" class="form-label">Observações</label>
                                    <textarea class="form-control @error('observacao') is-invalid @enderror" id="observacaoInput" name="observacao"
                                        disabled>{{ $grupo->observacao }}</textarea>
                                    @error('observacao')
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

                                        <a href="{{ url('admin/grupo-de-negocios/' . $grupo->id . '/edit') }}"
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
