@extends ('layouts.dashboard')

@section('title', 'Alterar Contrato')

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
                            <form method="POST" action="{{ route('admin.contratos.update', $contrato->id) }}" enctype="multipart/form-data">

                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                                @method('PUT')

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                                </div>

                                <div class="card-body">

                                    <div class="mb-3">
                                        <label id="numero_contratoLabel" class="form-label">Número Contrato</label>
                                        <input type="text" class="form-control @error('numero_contrato') is-invalid @enderror"
                                            id="numero_contratoInput" name="numero_contrato" value="{{ $contrato->numero_contrato }}">
                                        @error('numero_contrato')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label id="statusLabel" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror"
                                                id="statusInput" name="status">
                                                <option value="" disabled>-- Altere o Status --</option>
                                                @foreach (['ativo', 'inativo'] as $opcao)
                                                    <option value="{{ $opcao }}"
                                                        {{ old('status', $contrato->status) == $opcao ? 'selected' : '' }}>
                                                        {{ ucfirst($opcao) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label id="arquivoLabel" class="form-label">Contrato</label>
                                            <input type="file"
                                                class="form-control @error('arquivo') is-invalid @enderror"
                                                id="arquivoInput" name="arquivo">
                                            @error('arquivo')
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
                                                <i class="ti ti-check me-1"></i>
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
