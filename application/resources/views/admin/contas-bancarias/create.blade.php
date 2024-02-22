@extends ('layouts.dashboard')

@section('title', 'Nova Conta Bancária')

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
                        <form method="POST" action="{{ route('admin.contas-bancarias.store') }}">
                            @csrf {{-- Prevenção do laravel de ataques a formularios --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label id="unidadeNegocioLabel" class="form-label">Unidade de Negócio</label>
                                        <select class="form-select" id="unidadeNegocioSelect" name="unidade_de_negocio_id">
                                            <option value="" selected disabled> -- Selecione a Unidade de Negócio --
                                            </option>
                                            @foreach($unidades as $unidade)
                                                @if($unidade->tipo_pessoa=='pf')
                                                    <option value="{{ $unidade->id }}">{{ $unidade->pessoaFisica->nome }}
                                                @else
                                                    <option value="{{ $unidade->id }}">{{ $unidade->pessoaJuridica->razao_social }}
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('unidade_de_negocio_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label id="tipoContaLabel" class="form-label">Tipo de Conta</label>
                                        <select class="form-select" id="tipoContaSelect" name="tipo_de_conta">
                                            <option value="" selected disabled> -- Selecione o tipo da Conta --</option>
                                            <option value="conta-corrente">Conta Corrente</option>
                                            <option value="conta-poupanca">Conta Poupança</option>
                                            <option value="conta-pagamento">Conta de Pagamento</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label id="bancoLabel" class="form-label">Banco</label>
                                        <select class="form-select" id="bancoSelect" name="codigo_banco">
                                            <option value="" selected disabled> -- Selecione o nome do Banco --</option>
                                            @foreach($bancos as $banco)
                                            <option value="{{ $banco->codigo }}">{{ $banco->nome }} ({{ $banco->codigo }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label id="agenciaLabel" class="form-label">Agência</label>
                                        <input type="text" class="form-control @error('agencia') is-invalid @enderror"
                                            id="agenciaInput" name="agencia" value="{{ old('agencia') }}" maxLength="4">
                                        @error('agencia')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label id="numeroContaLabel" class="form-label">Número da Conta (com
                                            dígito)</label>
                                        <input type="text"
                                            class="form-control @error('numero_conta') is-invalid @enderror"
                                            id="numeroContaInput" name="numero_conta" value="{{ old('numero_conta') }}">
                                        @error('numero_conta')
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

@endsection