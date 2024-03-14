@extends ('layouts.main')

@section('title', 'Novo Usuário')

@section('sidebar')

    <x-sidebar-proprietario></x-sidebar-proprietario>
@endsection

@section('navbar')
    <x-navbar-proprietario></x-navbar-proprietario>
@endsection


@section('content')

    <div class="container-fluid">

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('proprietario.user.store') }}">
                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label id="nameLabel" class="form-label">Nome</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="nameInput" name="name" value="{{ old('name') }}" placeholder= "Digite o nome completo...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                        <label id="cpfLabel" class="form-label">CPF</label>
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                            id="cpfInput" name="cpf" placeholder="CPF" value="{{ old('cpf') }}"
                                            maxlength="14" oninput="mascaraCPF(this)">
                                        @error('cpf')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Telefone</label>
                                            <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                                class="form-control telefone @error('telefone') is-invalid @enderror"
                                                id="telefoneInput" name="telefone" placeholder="Telefone"
                                                value="{{ old('telefone') }}">
                                            @error('telefone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label id="emailLabel" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="emailInput" name="email" placeholder="Email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Senha Temporária</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('senha_temporaria') is-invalid @enderror"
                                                id="senha_temporaria" name="senha_temporaria"
                                                value="{{ old('senha_temporaria') }}"
                                                placeholder="Clique no botão para gerar senha">

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


<!-- {{-- Gerar Senha Temporaria --}} -->
<script src="{{ asset('assets/js/gerarSenhaTemporaria.js') }}"></script>

@endsection