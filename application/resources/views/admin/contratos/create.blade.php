@extends ('layouts.main')

@section('title', 'Novo Contrato')

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
                            <form method="POST" action="{{ route('admin.contratos.store') }}" enctype="multipart/form-data">
                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label id="numero_contratoLabel" class="form-label">Número Contrato</label>
                                            <input type="text"
                                                class="form-control @error('numero_contrato') is-invalid @enderror"
                                                id="numero_contratoInput" name="numero_contrato" placeholder="Nº"
                                                value="{{ old('numero_contrato') }}">
                                            @error('numero_contrato')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label id="planoLabel" class="form-label">Planos</label>
                                            <select class="form-select @error('plano_id') is-invalid @enderror"
                                                id="planoInput" name="plano_id">
                                                <option value="" disabled selected>--Selecione um plano--
                                                </option>
                                                @foreach ($planos as $plano)
                                                    <option value="{{ $plano->id }}"
                                                        {{ old('plano_id') == $plano->id ? 'selected' : '' }}>
                                                        {{ $plano->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('plano_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label id="arquivoLabel" class="form-label">Contrato</label>
                                            <input type="file" class="form-control @error('arquivo') is-invalid @enderror"
                                                id="arquivoInput" name="arquivo">
                                            @error('arquivo')
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
