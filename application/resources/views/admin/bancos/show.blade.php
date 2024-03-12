@extends ('layouts.main')

@section('title', 'Detalhar Banco')

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
                        <form method="POST" action="{{ route('admin.bancos.store') }}" enctype="multipart/form-data">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-user" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Bancários</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label id="nomeLabel" class="form-label">Nome do Banco</label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                            id="nomeInput" name="nome" placeholder="Nome Completo"
                                            value="{{ $banco->nome }}" disabled>
                                    </div>

                                    <div class="mb-6 col-md-6">
                                        <label id="codigoLabel" class="form-label">Código</label>
                                        <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                            id="codigoInput" name="codigo" placeholder="Código"
                                            value="{{ $banco->codigo }}" maxLength="3" disabled>
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
                                        <a href="{{ url('admin/banco/' . $banco->id . '/edit') }}"
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