@extends ('layouts.main')

@section('title', 'Detalhar Pessoa Jurídica')

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
                        <form method="POST" action="{{ route('admin.pessoa-juridica.store') }}"
                            enctype="multipart/form-data">
                            @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                            <div class="alert alert-light">
                                <i class="ti ti-user" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-6 col-md-6">
                                        <label id="razaoSocialLabel" class="form-label">Razão Social</label>
                                        <input type="text"
                                            class="form-control @error('razao_social') is-invalid @enderror"
                                            id="razaoSocialInput" name="razao_social" placeholder="Razão Social"
                                            value="{{ $pessoa->razao_social }}" disabled>
                                    </div>
                                    <div class="mb-6 col-md-6">
                                        <label id="nomeFantasiaLabel" class="form-label">Nome Fantasia</label>
                                        <input type="text"
                                            class="form-control @error('nome_fantasia') is-invalid @enderror"
                                            id="nomeFantasiaInput" name="nome_fantasia" placeholder="Nome Fantasia"
                                            value="{{ $pessoa->nome_fantasia }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label id="cnpjLabel" class="form-label">CNPJ</label>
                                        <input type="text" class="form-control @error('cnpj') is-invalid @enderror"
                                            id="cnpjInput" name="cnpj" placeholder="CNPJ" value="{{ substr($pessoa->cnpj, 0, 2) }}.{{ substr($pessoa->cnpj, 2, 3) }}.{{ substr($pessoa->cnpj, 5, 3) }}/{{ substr($pessoa->cnpj, 8, 4) }}-{{ substr($pessoa->cnpj, 12, 2) }}"
                                            maxlength="14" disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Inscrição Estadual</label>
                                        <input type="tel"
                                            class="form-control telefone @error('inscricao_estadual') is-invalid @enderror"
                                            id="inscricaoEstadualInput" name="inscricao_estadual"
                                             value="{{ ucfirst($pessoa->inscricao_estadual) }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Inscrição Municipal</label>
                                        <input type="tel"
                                            class="form-control telefone @error('inscricao_municipal') is-invalid @enderror"
                                            id="inscricaoMunicipalInput" name="inscricao_municipal"
                                             value="{{ $pessoa->inscricao_municipal }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light">
                                <i class="ti ti-message" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Contato</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Telefone</label>
                                        @foreach ($pessoa->telefones as $telefone)
                                        <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                            class="form-control telefone" id="telefoneInput" name="telefone"
                                             value="{{ $telefone->telefone }}" disabled>
                                        @endforeach
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label id="emailLabel" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="emailInput" name="email"
                                            value="{{ $pessoa->email  }}" disabled>
                                    </div>
                                </div>
                            </div>




                            <div class="alert alert-light">
                                <i class="ti ti-address-book" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Endereço</label>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="mb-3">
                                        <label id="logradouroLabel" class="form-label">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouroInput" name="logradouro"
                                           
                                            value="{{ $pessoa->enderecos->first()->tipoDeLogradouro->descricao . ' ' . $pessoa->enderecos->first()->logradouro }}"
                                            disabled>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label id="numeroLabel" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numeroInput" name="numero"
                                            value="{{ $pessoa->enderecos->first()->numero }}"
                                            disabled>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label id="complementoLabel" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complementoInput" name="complemento"
                                            
                                            value="{{ $pessoa->enderecos->first()->complemento }}" disabled>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label id="bairroLabel" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairroInput" name="bairro"
                                            value="{{ $pessoa->enderecos->first()->bairro }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="estadoSelect" class="form-label">Estado</label>
                                        <input type="text" class="form-control"
                                            value="{{ $pessoa->enderecos->first()->estado->nome }}" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="cidadeSelect" class="form-label">Cidade</label>
                                        <input type="text" class="form-control"
                                            value="{{ $pessoa->enderecos->first()->cidade->nome }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light">
                                <i class="ti ti-image" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Imagem</label>
                            </div>

                            <div class="mb-3">
                                <div class="card">
                                    <div class="text-left card-body">
                                        @if ($pessoa->imagem === 'imagem_padrao')
                                        <img src="{{ asset('assets/images/profile/imagem_user.svg') }}" width="200"
                                            height="200" class="rounded img-fluid" alt="Imagem Padrão">
                                        @else
                                        <img src="{{ asset('img/pessoaJuridica/' . $pessoa->imagem) }}"
                                            class="rounded img-fluid" width="200" height="200">
                                        @endif
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
                                        <a href="{{ url('admin/pessoa-juridica/' . $pessoa->id . '/edit') }}"
                                            class="btn btn-success me-2">
                                            <i class="ti ti-edit me-1"></i>
                                            Editar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--  inicio - Script para Buscar Cidade dinamicamente de acordo com o Estado -->
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
                                            $('#cidadeSelect').append(
                                                '<option value="' + value
                                                .id + '">' +
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

                    <!--  Fim - Script para Buscar Cidade dinamicamente de acordo com o Estado -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection