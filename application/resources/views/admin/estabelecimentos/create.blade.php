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

                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
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

                                <div class="alert alert-light">
                                    <i class="ti ti-address-book" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Endereço</label>
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


                                    <div class="mb-3">
                                        <label for="estadoSelect" class="form-label">Estado</label>
                                        <select class="form-select @error('estado') is-invalid @enderror"
                                            id="estadoSelect" name="estado">
                                            <option value="" selected disabled> -- Selecione o estado -- </option>
                                            @foreach($estados as $estado)
                                            <option value="{{ $estado->id }}"
                                                {{ old('estado') == $estado->id ? 'selected' : '' }}>{{ $estado->nome }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('estado')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="cidadeSelect" class="form-label">Cidade</label>
                                        <select class="form-select @error('cidade') is-invalid @enderror"
                                            id="cidadeSelect" name="cidade">
                                            <option value="" selected disabled> -- Selecione a cidade -- </option>
                                            @foreach($cidades as $cidade)
                                            <option value="{{ $cidade->id }}"
                                                {{ old('cidade') == $cidade->id ? 'selected' : '' }}>{{ $cidade->nome }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('cidade')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                </div>

                                <div class="alert alert-light">
                                    <i class="ti ti-user" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Responsável</label>
                                </div>


                                <div class="card-body">
                                    <div class="mb-3">
                                        <label id="nomeCompletoLabel" class="form-label">Nome Completo</label>
                                        <input type="text"
                                            class="form-control @error('nome_responsavel') is-invalid @enderror"
                                            id="nomeCompletoInput" name="nome_responsavel" placeholder="Nome Completo"
                                            value="{{ old('nome_responsavel') }}">
                                        @error('nome_responsavel')
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


    <!-- Script para alterar os campos CPF e CNPJ de acordo com  regime -->

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


    <!--  Script para Buscar Cidade dinamicamente de acordo com o Estado -->
    <script>
$(document).ready(function() {
    // Desabilitar o campo de cidade inicialmente
    $('#cidadeSelect').prop('disabled', true);

    $('#estadoSelect').change(function() {
        var estado_id = $(this).val();

        // Limpar o dropdown de cidades
        $('#cidadeSelect').empty();

        if (estado_id) {
            // Remover o atributo disabled quando um estado for selecionado
            $('#cidadeSelect').prop('disabled', false);

            // Fazer a solicitação AJAX para obter as cidades do estado selecionado
            $.ajax({
                url: '/api/cidades/' + estado_id,
                type: 'GET',
                success: function(data) {
                    // Adicionar as opções de cidades ao dropdown
                    $.each(data, function(key, value) {
                        $('#cidadeSelect').append('<option value="' + value.id + '">' +
                            value.nome + '</option>');
                    });
                }
            });
        } else {
            // Se nenhum estado for selecionado, desabilitar novamente o campo de cidade
            $('#cidadeSelect').prop('disabled', true);
        }
    });
});
</script>


    @endsection