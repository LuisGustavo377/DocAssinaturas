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

                                <div class="alert alert-success">
                                    Dados Cadastrais
                                </div>

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Regime</label><br>
                                        <select name="regime" id="regime" class="form-control" required>
                                            <option value="">-- Selecione um regime --</option>
                                            <option value="PF" @if(old('regime')==='PF' ) selected @endif>Pessoa
                                                Física </option>
                                            <option value="PJ" @if(old('regime')==='PJ' ) selected @endif>Pessoa
                                                Jurídica</option>
                                        </select>
                                    </div>


                                    <div class="mb-3" id="cpfContainer">
                                        <label class="form-label">CPF</label>
                                        <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                            id="cpfInput" name="cpf" placeholder="CPF" value="{{ old('cpf') }}"
                                            minLength="11" maxLength="11" required>
                                        @error('cpf')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3" id="cnpjContainer" style="display: none;">
                                        <label class="form-label">CNPJ</label>
                                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror"
                                            id="cnpjInput" name="cnpj" placeholder="CNPJ" value="{{ old('cnpj') }}"
                                            minLength="14" maxLength="14" required>
                                        @error('cnpj')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

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

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail1" name="email" placeholder="seumail@email.com"
                                            aria-describedby="emailHelp" value="{{ old('email') }}">
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
                                </div>

                                <div class="alert alert-success">
                                    Contato
                                </div>

                                <div class="card-body">

                                    <div class="mb-3">
                                        <label id="logradouroLabel" class="form-label">Logradouro</label>
                                        <input type="text"
                                            class="form-control @error('logradouro') is-invalid @enderror"
                                            id="logradouroInput" name="logradouro" placeholder="Ex.: Rua Um"
                                            value="{{ old('logradouro') }}">
                                        @error('logradouro')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label id="numeroLabel" class="form-label">Número</label>
                                        <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                            id="numeroInput" name="numero" placeholder="Número"
                                            value="{{ old('numero') }}">
                                        @error('numero')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="complementoLabel" class="form-label">Complemento</label>
                                        <input type="text"
                                            class="form-control @error('complemento') is-invalid @enderror"
                                            id="complementoInput" name="complemento"
                                            placeholder="Ex: Casa, Sala, Galpão" value="{{ old('complemento') }}">
                                        @error('complemento')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="numeroLabel" class="form-label">Bairro</label>
                                        <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                            id="bairroInput" name="bairro" placeholder="Bairro"
                                            value="{{ old('bairro') }}">
                                        @error('bairro')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="grid grid-cols-2 gap-1 justify-evenly">
                                        <div class="mt-4 text-sm">
                                            <label class="block mt-4 text-sm">
                                                <span class="text-gray-700 dark:text-gray-400"> Estado </span>
                                                <select name="estado" id="estado" onchange="getCidades()"
                                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                                    required>
                                                    <option value="0">Selecione o Estado</option>
                                                    @foreach ($estados as $estado)
                                                    <option value="{{ $estado->id }}"
                                                        {{ old('estado') == $estado->id ? 'selected' : '' }}>
                                                        {{ $estado->nome }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </div>


                                        <div class="mt-4 text-sm">
                                            <label class="block mt-4 text-sm">
                                                <span class="text-gray-700 dark:text-gray-400"> Cidade </span>
                                                <select name="cidade" id="cidade"
                                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                                    required>
                                                    <option value="">Selecione uma cidade</option>
                                                    @foreach ($cidades as $cidade)
                                                    <option value="{{ $cidade->id }}"
                                                        {{ old('cidade') == $cidade->id ? 'selected' : '' }}>
                                                        {{ $cidade->nome }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <button id="loadingButton"
                                                    class="flex items-center justify-between hidden px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-purple'">
                                                    <svg aria-hidden="true" role="status"
                                                        class="inline w-4 h-4 mr-3 text-white animate-spin"
                                                        viewBox="0 0 100 101" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="#E5E7EB" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    Carregando Cidades...
                                                </button>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="alert alert-success">
                                    Responsável
                                </div>

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label id="nomeCompletoLabel" class="form-label">Nome Completo</label>
                                        <input type="text"
                                            class="form-control @error('nome_completo') is-invalid @enderror"
                                            id="nomeCompletoInput" name="nome_completo" placeholder="Nome Completo"
                                            value="{{ old('nome_completo') }}">
                                        @error('nome_completo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Telefone</label>
                                        <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                            class="form-control telefone @error('telefone_responsavel') is-invalid @enderror"
                                            id="telefoneInput" name="telefone_responsavel" placeholder="Telefone"
                                            value="{{ old('telefone_responsavel') }}">
                                        @error('telefone_responsavel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3" id="cpfContainer">
                                        <label class="form-label">CPF</label>
                                        <input type="text"
                                            class="form-control @error('cpf_responsavel') is-invalid @enderror"
                                            id="cpfInput" name="cpf_responsavel" placeholder="CPF"
                                            value="{{ old('cpf_responsavel') }}" minLength="11" maxLength="11" required>
                                        @error('cpf_responsavel')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label id="emailLabel" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('email_responsavel') is-invalid @enderror"
                                            id="emailInput" name="email_responsavel"
                                            placeholder="emailresponsavel@email.com"
                                            value="{{ old('email_responsavel') }}">
                                        @error('email_responsavel')
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


    <!-- Script para gerar senha temporaria -->
    <script>
function generateTemporaryPassword() {
    const temporaryPasswordInput = document.getElementById('senha_temporaria');
    const temporaryPassword = Math.random().toString(36).slice(-8); // Generate an 8-character random string
    temporaryPasswordInput.value = temporaryPassword;
}
    </script>

    <!-- Script de Mascara de Telefone -->

    <script>
$(document).ready(function() {
    // Máscara para telefone fixo (ex: (99) 9999-9999)
    $('#telefoneInput').mask('(00) 0000-0000');

    // Máscara para telefone celular (ex: (99) 99999-9999)
    $('#telefoneInput').mask('(00) 00000-0000', {
        clearIfNotMatch: true
    });
});
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
$(document).ready(function() {
    // Função para atualizar a visibilidade e o estado dos campos CPF e CNPJ
    function updateFieldsVisibility() {
        var regime = $("#regime").val();

        if (regime === "PF") {
            $("#cpfContainer").show();
            $("#cpfInput").prop("disabled", false);
            $("#cnpjContainer").hide();
            $("#cnpjInput").prop("disabled", true);
            $("#nomeLabel").text("Nome");
        } else if (regime === "PJ") {
            $("#cpfContainer").hide();
            $("#cpfInput").prop("disabled", true);
            $("#cnpjContainer").show();
            $("#cnpjInput").prop("disabled", false);
            $("#nomeLabel").text("Razão Social");
        } else {
            $("#cpfContainer").hide();
            $("#cpfInput").prop("disabled", true);
            $("#cnpjContainer").hide();
            $("#cnpjInput").prop("disabled", true);
            $("#nomeLabel").text("Nome");
        }
    }

    // Chamada inicial para configurar o estado dos campos com base no valor inicial do regime
    updateFieldsVisibility();

    // Adiciona um ouvinte de eventos para detectar alterações no campo de regime
    $("#regime").on("change", function() {
        updateFieldsVisibility();
    });
});
    </script>



<!-- Inicio JavaScript que Busca Cidade -->
<script>
document.getElementById('estado').addEventListener('change', function() {
    var estadoId = this.value;
    var cidadeSelect = document.getElementById('cidade');
    var loadingButton = document.getElementById('loadingButton');

    cidadeSelect.disabled = true;
    loadingButton.classList.remove('hidden');

    if (!estadoId) {
        cidadeSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
        loadingButton.classList.add('hidden');
        return;
    }

    // Faz uma requisição AJAX para obter as cidades do estado selecionado
    fetch('/estabelecimentos/get-cidades?estado_id=' + estadoId)
        .then(response => response.json())
        .then(data => {
            var listaCidades = '<option value="">Selecione uma cidade</option>';

            data.forEach(cidade => {
                listaCidades += '<option value="' + cidade.id + '">' + cidade.nome + '</option>';
            });

            cidadeSelect.innerHTML = listaCidades;
            cidadeSelect.disabled = false;
            loadingButton.classList.add('hidden');
        });
});
</script>

<!-- Fim JavaScript que Busca Cidade -->




    @endsection