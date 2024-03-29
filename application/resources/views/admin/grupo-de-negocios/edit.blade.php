@extends ('layouts.main')

@section('title', 'Alterar Grupo de Negócios')

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
                            <form method="POST" action="{{ route('admin.grupo-de-negocios.update', $grupo->id) }}">

                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                                @method('PUT')

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label id="nomeLabel" class="form-label">Nome</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="nomeInput" name="name" value="{{ $grupo->nome }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label id="statusLabel" class="form-label">Status</label>
                                            <select class="form-select @error('status') is-invalid @enderror"
                                                id="statusInput" name="status">
                                                <option value="" disabled>-- Altere o Status --</option>
                                                @foreach (['ativo', 'inativo'] as $opcao)
                                                    <option value="{{ $opcao }}"
                                                        {{ old('status', $grupo->status) == $opcao ? 'selected' : '' }}>
                                                        {{ ucfirst($opcao) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label id="observacaoLabel" class="form-label">Observações</label>
                                        <textarea class="form-control @error('observacao') is-invalid @enderror" id="observacaoInput" name="observacao">{{ $grupo->observacao }}</textarea>
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
