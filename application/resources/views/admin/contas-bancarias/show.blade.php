@extends('layouts.dashboard')

@section('title', 'Detalhar Conta Bancária')

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
                    <form method="POST" action="#">
                        @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                        <div class="alert alert-light">
                            <i class="ti ti-file-description" style="color: #13deb9"></i>
                            <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 md-6">
                                    <label class="form-label">Unidade de Negócio</label>
                                    <input type="text" class="form-control" @if ($conta->unidadeDeNegocio->tipo_pessoa
                                    == 'pf')
                                    value="{{ $conta->unidadeDeNegocio->pessoaFisica->nome }}"
                                    @else
                                    value="{{ $conta->unidadeDeNegocio->pessoaJuridica->razao_social }}"
                                    @endif
                                    disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-6">
                                    <label class="form-label">Tipo de Conta</label>
                                    <input type="text" class="form-control" value="@if($conta->tipo_de_conta == 'conta-corrente')Conta Corrente @elseif($conta->tipo_de_conta == 'conta-pagamento')Conta de Pagamento@elseif($conta->tipo_de_conta == 'conta-poupanca')
                                            Conta Poupança
                                        @endif
                                    " disabled>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label class="form-label">Banco</label>
                                    @if($conta->banco)
                                    <input type="text" class="form-control" value="{{ $conta->banco->nome }}" disabled>
                                    @else
                                    <input type="text" class="form-control" value="Nenhum banco associado" disabled>
                                    @endif
                                </div>
                                <!-- teste -->

                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-6">
                                    <label class="form-label">Agência</label>
                                    <input type="text" class="form-control" value="{{ $conta->agencia }}" disabled>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label class="form-label">Status</label><br>
                                    <span
                                        class="badge bg-{{ $conta->status === 'ativo' ? 'success' : ($conta->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($conta->status) }}
                                    </span>
                                </div>
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

                            <a href="{{ url('admin/conta-bancaria/' . $conta->id . '/edit') }}"
                                class="btn btn-success me-2">
                                <i class="ti ti-edit me-1"></i>
                                Editar
                            </a>

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