    @extends ('layouts.dashboard')

    @section('title', 'Criar Estabelecimento')

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
                            <form method="POST" action="{{ route('admin.estabelecimento.store') }}">

                                @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                                <div class="mb-3">
                                    <label class="form-label">Regime</label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('regime') is-invalid @enderror"
                                            type="radio" name="regime" id="pfCheckbox" value="pf"
                                            {{ old('regime') == 'pf' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pfCheckbox">PF</label>

                                        @error('regime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('regime') is-invalid @enderror"
                                            type="radio" name="regime" id="pjCheckbox" value="pj"
                                            {{ old('regime') == 'pj' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pjCheckbox">PJ</label>

                                        @error('regime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="docInput" class="form-label" id="docLabel">
                                        {{ old('regime') == 'pj' ? 'CNPJ' : 'CPF' }}
                                    </label>
                                    <input type="text"
                                        class="form-control @error(old('regime') == 'pf' ? 'cpf' : 'cnpj') is-invalid @enderror"
                                        id="docInput" name="{{ old('regime') == 'pf' ? 'cpf' : 'cnpj' }}"
                                        placeholder="{{ old('regime') == 'pj' ? 'CNPJ' : 'CPF' }}"
                                        value="{{ old('regime') == 'pj' ? old('cnpj') : old('cpf') }}">
                                    @error(old('regime') == 'pf' ? 'cpf' : 'cnpj')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="nomeInput" name="nome" placeholder="Nome" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" class="form-control @error('telefone') is-invalid @enderror"
                                        id="telefoneInput" name="telefone" placeholder="Telefone"
                                        value="{{ old('telefone') }}">
                                    @error('telefone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="exampleInputEmail1" name="email" placeholder="seumail@email.com" aria-describedby="emailHelp"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Senha Temporária</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('senha_temporaria') is-invalid @enderror"
                                            id="senha_temporaria" name="senha_temporaria"
                                            value="{{ old('senha_temporaria') }}" placeholder="Clique no botão ao lado para gerar senha" readonly>
                                        @error('senha_temporaria')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <button type="button" class="btn btn-outline-success"
                                            onclick="generateTemporaryPassword()">Gerar Senha</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputLogotipo" class="form-label">Logotipo</label>
                                    <input type="file" class="form-control @error('logotipo') is-invalid @enderror"
                                        id="logotipo" name="logotipo" placeholder="Selecione seu arquivo"
                                        value="{{ old('logotipo') }}">
                                    @error('logotipo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

    <script>
// Add event listener to toggle between CPF and CNPJ labels and inputs based on regime selection
const pfCheckbox = document.getElementById('pfCheckbox');
const pjCheckbox = document.getElementById('pjCheckbox');
const docLabel = document.getElementById('docLabel');
const docInput = document.getElementById('docInput');

pfCheckbox.addEventListener('change', toggleDocFields);
pjCheckbox.addEventListener('change', toggleDocFields);

function toggleDocFields() {
    if (pfCheckbox.checked) {
        docLabel.innerText = 'CPF';
        docInput.placeholder = 'CPF';
        docInput.name = 'cpf';
        docInput.value = "{{ old('cpf') }}";
        docInput.class = 'form-control @error('
        cpf ') is-invalid @enderror';
    } else if (pjCheckbox.checked) {
        docLabel.innerText = 'CNPJ';
        docInput.placeholder = 'CNPJ';
        docInput.name = 'cnpj';
        docInput.value = "{{ old('cnpj') }}";
        docInput.class = 'form-control @error('
        cnpj ') is-invalid @enderror';
    }
}
    </script>

    <script>
function generateTemporaryPassword() {
    const temporaryPasswordInput = document.getElementById('senha_temporaria');
    const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
    temporaryPasswordInput.value = temporaryPassword;
}
    </script>



    @endsection