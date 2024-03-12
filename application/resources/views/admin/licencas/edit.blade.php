@extends ('layouts.main')

@section('title', 'Alterar Licença')

@section('sidebar')
<x-sidebar-admin></x-sidebar-admin>
@endsection

@section('navbar')
<x-navbar-admin></x-navbar-admin>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.licencas.update', $licenca->id) }}">

                        @csrf {{-- Prevenção do laravel de ataques a formularios --}}
                        @method('PUT')

                        <div class="alert alert-light">
                            <i class="ti ti-file-description" style="color: #13deb9"></i>
                            <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                <input type="text" class="form-control" id="nomeGrupoInput" name="grupo_de_negocio_id"
                                    value="{{ $licenca->grupoDeNegocios->nome }}" disabled>
                            </div>

                            @if($unidade_de_negocio->tipo_pessoa=='pf')
                            <div class="mb-3">
                                <label id="grupoLabel" class="form-label">Unidade de Negócio</label>
                                <input type="text" class="form-control" id="nomeGrupoInput" name="grupo_de_negocio_id"
                                    value="{{ $unidade_de_negocio->nome }}" disabled>
                            </div>

                            @else

                            <div class="mb-3">
                                <label id="grupoLabel" class="form-label">Unidade de Negócio</label>
                                <input type="text" class="form-control" id="nomeGrupoInput" name="grupo_de_negocio_id"
                                    value="{{ $unidade_de_negocio->razao_social }}" disabled>
                            </div>

                            @endif

                        </div>

                        
                        <div class="alert alert-light">
                            <i class="ti ti-file-description" style="color: #13deb9"></i>
                            <label class="form-label" style="color: #13deb9">Dados do Contrato</label>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label id="numeroContratoLabel" class="form-label">Número Contrato</label>
                                    <input type="text"
                                        class="form-control @error('numero_contrato') is-invalid @enderror"
                                        id="numeroContratoInput" name="numero_contrato" placeholder="Número Contrato"
                                        value="{{ $licenca->numero_contrato }}" disabled>
                                    @error('numero_contrato')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label id="tipoDeRenovacaoLabel" class="form-label">Tipo de Renovação</label>
                                    <select class="form-select @error('tipo_de_renovacao') is-invalid @enderror"
                                        id="tipoDeRenovacaoInput" name="tipo_de_renovacao_id">
                                        <option value="" disabled>-- Selecione um tipo de renovação --</option>
                                        @foreach ($tiposDeRenovacao as $tipo)
                                        <option value="{{ $tipo['id'] }}"
                                            {{ $licenca->tipo_de_renovacao == $tipo['id'] ? 'selected' : '' }}>
                                            {{ $tipo['descricao'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_de_renovacao')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label id="statusLabel" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="statusInput"
                                        name="status">
                                        <option value="" disabled>-- Altere o Status --</option>
                                        @foreach (['ativo', 'inativo', 'bloqueado'] as $opcao)
                                        <option value="{{ $opcao }}"
                                            {{ old('status', $licenca->status) == $opcao ? 'selected' : '' }}>
                                            {{ ucfirst($opcao) }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label id="inicioLabel" class="form-label">Início</label>
                                    <input type="date" class="form-control @error('inicio') is-invalid @enderror"
                                        id="inicioInput" name="inicio" placeholder="Início"
                                        value="{{ $licenca->inicio }}">
                                    @error('inicio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label id="terminoLabel" class="form-label">Término</label>
                                    <input type="date" class="form-control @error('termino') is-invalid @enderror"
                                        id="terminoInput" name="termino" placeholder="Término"
                                        value="{{ $licenca->termino }}">
                                    @error('termino')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label id="descricaoLabel" class="form-label">Descrição</label>
                                <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                    id="descricaoInput" name="descricao" placeholder="Descrição"
                                    value="{{ $licenca->descricao }}" disabled>
                                @error('descricao')
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
                </div>


                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection