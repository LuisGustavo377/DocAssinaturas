@extends('layouts.dashboard')

@section('title', 'Nova Licença')

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

                        <form method="POST" action="{{ route('admin.licencas.store') }}">
                            @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="mb-3">
                                    <label id="grupoLabel" class="form-label">Grupo de Negócio</label>
                                    <select class="form-select @error('grupos_de_negocio_id') is-invalid @enderror"
                                        id="grupoInput" name="grupos_de_negocio_id">
                                        <option value="" disabled selected>--Selecione um grupo de negócio--</option>
                                        @foreach ($gruposDeNegocios as $grupo)
                                            <option value="{{ $grupo->id }}"
                                                {{ old('grupos_de_negocio_id') == $grupo->id ? 'selected' : '' }}>
                                                {{ $grupo->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grupos_de_negocio_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label id="numeroContratoLabel" class="form-label">Número Contrato</label>
                                        <select class="form-select @error('contrato_id') is-invalid @enderror"
                                            id="numeroContratoInput" name="contrato_id">
                                            <option value="" disabled selected>--Selecione um contrato--</option>
                                            @foreach ($contratos as $contrato)
                                                <option value="{{ $contrato->id }}"
                                                    {{ old('contrato_id') == $contrato->id ? 'selected' : '' }}>
                                                    {{ $contrato->numero_contrato }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Adicionando o campo oculto para numero_contrato -->
                                        <input type="hidden" id="numeroContratoHidden" name="numero_contrato"
                                            value="">

                                        @error('contrato_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label id="tipoDeRenovacaoLabel" class="form-label">Tipo de Renovação</label>
                                        <select class="form-select @error('tipo_de_renovacao') is-invalid @enderror"
                                            id="tipoDeRenovacaoInput" name="tipo_de_renovacao">

                                            <option value="" selected disabled>-- Selecione um tipo de renovação --
                                            </option>

                                            @foreach ($tiposDeRenovacao as $tipo)
                                                <option value="{{ $tipo['id'] }}"
                                                    {{ old('tipo_de_renovacao') == $tipo['id'] ? 'selected' : '' }}>
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

                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label id="inicioLabel" class="form-label">Início</label>
                                        <input type="date" class="form-control @error('inicio') is-invalid @enderror"
                                            id="inicioInput" name="inicio" placeholder="Início"
                                            value="{{ old('inicio') }}">
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
                                            value="{{ old('termino') }}">
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
                                        value="{{ old('descricao') }}">
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
                                            <i class="ti ti-plus me-1"></i>
                                            Cadastrar
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
    </div>

{{--  Sempre que o usuário selecionar um contrato no campo de seleção,
 o valor do campo oculto numero_contrato será atualizado com o número do contrato selecionado.--}}
<script>
    document.getElementById('numeroContratoInput').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('numeroContratoHidden').value = selectedOption.innerText;
    });
</script>

@endsection
