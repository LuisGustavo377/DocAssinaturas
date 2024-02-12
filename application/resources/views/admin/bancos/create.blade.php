@extends ('layouts.dashboard')

@section('title', 'Criar Banco')

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
                        <form method="POST" action="{{ route('admin.bancos.store') }}" enctype="multipart/form-data">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-user" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Bancários</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-6">
                                        <label id="nomeLabel" class="form-label">Nome do Banco</label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                            id="nomeInput" name="nome" placeholder="Nome Completo"
                                            value="{{ old('nome') }}">
                                        @error('nome')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-6">
                                        <label id="codigoLabel" class="form-label">Código</label>
                                        <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                            id="codigoInput" name="codigo" placeholder="Código"
                                            value="{{ old('codigo') }}" maxLength="3">
                                        @error('codigo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
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