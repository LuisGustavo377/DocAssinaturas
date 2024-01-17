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
                    <form method="POST" action="{{ route('estabelecimentos.store') }}" enctype="multipart/form-data">

                    @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                            <div class="mb-3">
                                <label class="form-label">Regime</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="regime" id="pfCheckbox"
                                        value="pf">
                                    <label class="form-check-label" for="pfCheckbox">PF</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="regime" id="pjCheckbox"
                                        value="pj">
                                    <label class="form-check-label" for="pjCheckbox">PJ</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" id="docLabel">CPF</label>
                                <input type="text" class="form-control" id="docInput" name="cpf" placeholder="CPF">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nomeInput" name="nome" placeholder="Nome">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefoneInput" name="telefone"
                                    placeholder="Telefone">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                    aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Senha Temporária</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="temporaryPasswordInput"
                                        name="temporary_password" readonly>
                                    <button type="button" class="btn btn-outline-success"
                                        onclick="generateTemporaryPassword()">Gerar Senha</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Logotipo</label>
                                <input type="file" class="form-control" id="logoInput" name="logo">
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
    } else if (pjCheckbox.checked) {
        docLabel.innerText = 'CNPJ';
        docInput.placeholder = 'CNPJ';
        docInput.name = 'cnpj';
    }
}
</script>

<script>
function generateTemporaryPassword() {
    const temporaryPasswordInput = document.getElementById('temporaryPasswordInput');
    const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
    temporaryPasswordInput.value = temporaryPassword;
}
</script>



@endsection