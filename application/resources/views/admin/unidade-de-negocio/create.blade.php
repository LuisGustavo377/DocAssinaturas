@extends ('layouts.dashboard')

@section('title', 'Unidade de Negócios')

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
                        <form method="POST" action="{{ route('admin.unidade-de-negocio.store') }}">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados de Vinculação</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                    <select class="form-select @error('grupo_id') is-invalid @enderror" id="grupoInput"
                                        name="grupo_id">
                                        <option value="" disabled selected>Selecione um grupo de negócio</option>
                                        @foreach ($gruposDeNegocios as $grupo)
                                        <option value="{{ $grupo->id }}"
                                            {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                            {{ $grupo->nome }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('grupo_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label id="pessoaLabel" class="form-label">Pessoa</label>
                                    <select class="form-select @error('pessoa_id') is-invalid @enderror"
                                        id="pessoaInput" name="pessoa_id">
                                        <option value="" disabled selected>Selecione uma pessoa</option>
                                        @foreach ($pessoas as $pessoa)
                                        <option value="{{ $pessoa->id }}"
                                            {{ old('pessoa_id') == $pessoa->id ? 'selected' : '' }}>
                                            {{ $pessoa->nome }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pessoa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>



                            <div class="alert alert-light">
                                <i class="ti ti-key" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Licença</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                        <label id="grupoLabel" class="form-label">Licença</label>
                                        <select class="form-select @error('grupo_id') is-invalid @enderror" id="grupoInput"
                                            name="grupo_id">
                                            <option value="" disabled selected>Selecione um grupo de negócio</option>
                                            @foreach ($gruposDeNegocios as $grupo)
                                                <option value="{{ $grupo->id }}"
                                                    {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                    {{ $grupo->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('grupo_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                            </div>

                                                        <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Login</label>
                            </div>

                            <div class="card-body">


                                <div class="mb-3">
                                    <label class="form-label">Senha Temporária</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('senha_temporaria') is-invalid @enderror"
                                            id="senha_temporaria" name="senha_temporaria"
                                            value="{{ old('senha_temporaria') }}"
                                            placeholder="Clique no botão para gerar senha" readonly>

                                        <button type="button" class="btn btn-outline-success"
                                            onclick="generateTemporaryPassword()">Gerar Senha</button>
                                        @error('senha_temporaria')
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

<!-- Inicio Gerar Senha Temporaria -->

<script>
function generateTemporaryPassword() {
    const temporaryPasswordInput = document.getElementById('senha_temporaria');
    const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
    temporaryPasswordInput.value = temporaryPassword;
}
</script>
<!-- Fim Gerar Senha Temporaria -->

@endsection