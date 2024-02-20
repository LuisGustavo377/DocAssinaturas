@extends('layouts.dashboard')

@section('title', 'Alterar Unidade de Negócio')

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
                            <form method="POST" action="{{ route('admin.unidade-de-negocio.update', $unidade->id) }}">
                                @csrf {{-- Prevenção do laravel de ataques a formulários --}}
                                @method('PUT')

                                <!-- Seção de Dados Cadastrais -->
                                <div class="alert alert-light">
                                    <i class="ti ti-file-description" style="color: #13deb9"></i>
                                    <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                                </div>

                                <div class="card-body">
                                    <!-- Campo Grupo de Negócio -->
                                    <div class="mb-3">
                                        <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                        <input type="text" class="form-control" id="nomeInput" name="name"
                                            value="{{ $grupo->nome }}" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="mb-6 col-md-6">
                                            <label class="form-label">Tipo de Pessoa</label>
                                            <input type="text" class="form-control" id="tipoPessoa" name="tipoPessoa"
                                                value="{{ $unidade->tipo_pessoa === 'pf' ? 'Pessoa Física' : 'Pessoa Jurídica' }}"
                                                disabled>
                                        </div>

                                        <div class="mb-6 col-md-6">
                                            <label class="form-label">Nome/Razão Social</label>
                                            <input type="text" class="form-control" id="nome-razaoSocial"
                                                name="nome-razaoSocial" value="{{ $nome }}" disabled>
                                        </div>

                                    </div>

                                    <!-- Campo Licença -->
                                    <div class="mb-3">
                                        <label id="licencaLabel" class="form-label">Licença</label>
                                        <select class="form-select" id="licencaInput" name="licenca_id">
                                            <option value="" disabled> -- Selecione uma licença -- </option>
                                            <!-- Opções de licença serão preenchidas dinamicamente pelo JavaScript -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Seção de Botões -->
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


    {{-- Buscar Licenças por grupo EDIT --}}
    <script>
        $(document).ready(function() {
            var grupo_de_negocio_id =
                "{{ $unidade->grupo_de_negocio_id }}"; // Obtém o ID do grupo de negócio da unidade
            var licenca_atual = "{{ $unidade->licenca_id }}"; // Obtém o ID da licença atual da unidade
            $.ajax({
                url: "/admin/licencas-por-grupo/",
                data: {
                    grupo_de_negocio_id: grupo_de_negocio_id
                },
                success: function(data) {
                    $('#licencaInput').empty();
                    if (data.length === 0) {
                        // Adicionar uma mensagem de aviso se não houver licenças encontradas
                        $('#licencaInput').append(
                            '<option value="" disabled selected>Nenhuma licença encontrada</option>'
                        );
                    } else {
                        // Adicionar as opções de licença normalmente se houver licenças encontradas
                        $('#licencaInput').append(
                            '<option value="" disabled> -- Selecione uma licença -- </option>');
                        $.each(data, function(index, licenca) {
                            var selected = (licenca.id == licenca_atual) ? 'selected' : '';
                            $('#licencaInput').append('<option value="' + licenca.id + '" ' +
                                selected + '>' + licenca.descricao + '</option>');
                        });
                    }
                }
            });
        });
    </script>
@endsection
