@extends ('layouts.main')

@section('title', 'Alterar Banco')

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
                    <form method="POST" action="{{ route('admin.bancos.update', $banco->id) }}"
                        enctype="multipart/form-data">
                        @csrf {{-- Prevenção do Laravel de ataques a formulários --}}
                        @method('PUT')

                        <div class="alert alert-light">
                            <i class="ti ti-user" style="color: #13deb9"></i>
                            <label class="form-label" style="color: #13deb9">Dados Bancários</label>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="mb-6 col-md-6">
                                    <label for="nomeInput" class="form-label">Nome Completo </label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                        id="nomeInput" name="nome" placeholder="Nome"
                                        value="{{ old('nome', $banco->nome) }}">
                                    @error('nome')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-6 col-md-6">
                                    <label for="codigoInput" class="form-label">Código</label>
                                    <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                        id="codigoInput" name="codigo" placeholder="Código" value="{{ $banco->codigo }}">
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection