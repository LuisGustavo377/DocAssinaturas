@extends ('layouts.dashboard')

@section('title', 'Criar Grupo de Negócios')

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
                        <form method="POST" action="{{ route('admin.grupo-de-negocios.store') }}">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <label id="nomeLabel" class="form-label">Nome</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="nomeInput" name="name" placeholder="Nome" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="observacaoLabel" class="form-label">Observações</label>
                                    <textarea class="form-control @error('observacao') is-invalid @enderror"
                                        id="observacaoInput" name="observacao"
                                        placeholder="Observações">{{ old('observacao') }}</textarea>
                                    @error('observacao')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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