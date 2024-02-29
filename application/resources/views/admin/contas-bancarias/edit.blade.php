@extends ('layouts.dashboard')

@section('title', 'Conta Bancária')

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


                <form method="POST" action="{{ route('admin.contas-bancarias.update', $conta->id) }}"
                    enctype="multipart/form-data">
                    @csrf {{-- Prevenção do Laravel de ataques a formulários --}}
                    @method('PUT')

                    <div class="alert alert-light">
                        <i class="ti ti-user" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 md-6">
                                <label class="form-label">Unidade de Negócio</label>
                                <input type="text" class="form-control" @if($conta->unidadeDeNegocio->tipo_pessoa ==
                                'pf') value="{{ $conta->unidadeDeNegocio->pessoaFisica->nome }}" @else
                                value="{{ $conta->unidadeDeNegocio->pessoaJuridica->razao_social }}" @endif
                                disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label id="tipoContaLabel" class="form-label">Tipo de Conta</label>
                                <select class="form-select" id="tipoContaSelect" name="tipo_de_conta">
                                    <option value="" disabled @if($conta->tipo_de_conta == '') selected @endif> --
                                        Selecione o tipo da Conta --</option>
                                    <option value="conta-corrente" @if($conta->tipo_de_conta == 'conta-corrente')
                                        selected @endif>Conta Corrente</option>
                                    <option value="conta-poupanca" @if($conta->tipo_de_conta == 'conta-poupanca')
                                        selected @endif>Conta Poupança</option>
                                    <option value="conta-pagamento" @if($conta->tipo_de_conta == 'conta-pagamento')
                                        selected @endif>Conta de Pagamento</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label id="bancoLabel" class="form-label">Banco</label>
                                <select class="form-select" id="bancoSelect" name="banco_id">
                                    <option value="" disabled selected> -- Selecione o nome do Banco --</option>
                                    @foreach($bancos as $banco)
                                    <option value="{{ $banco->id }}" @if($banco->id == $conta->banco_id) selected
                                        @endif>{{ $banco->nome }} ({{ $banco->codigo }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-6">
                                <label class="form-label">Agência</label>
                                <input type="text" class="form-control" name="agencia" id="agenciaInput"
                                    value="{{ $conta->agencia }}" maxLength="4">
                            </div>
                            <div class="col-md-6 mb-6">
                                <label class="form-label">Conta</label>
                                <input type="text" class="form-control" name="numero_conta" id="contaInput"
                                    value="{{ $conta->numero_conta }}">
                            </div>

                        </div>
                        <div class="row">
                        <div class="col-md-12 mb-6">
                                <label id="statusLabel" class="form-label">Status</label>
                                <select class="form-select" id="statusSelect" name="status">
                                    <option value="ativo" @if($conta->status == 'ativo') selected @endif>Ativo
                                    </option>
                                    <option value="inativo" @if($conta->status == 'inativo') selected @endif>Inativo
                                    </option>
                                </select>
                            </div>
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
                                    <i class="ti ti-edit me-1"></i>
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

@endsection