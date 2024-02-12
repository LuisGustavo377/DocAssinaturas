@extends('layouts.dashboard')

@section('title', 'Bancos')

@section('sidebar')
<x-sidebar-admin></x-sidebar-admin>
@endsection

@section('navbar')
<x-navbar-admin></x-navbar-admin>
@endsection

@section('content')

<div class="container-fluid">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold">Banco</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{ route('admin.bancos.create') }}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulário da Barra de Pesquisa -->
                <form action="{{ route('admin.bancos.search') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Buscar por nome do banco ou código...">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="ti ti-search"></i>
                            Pesquisar
                        </button>
                    </div>
                </form>

                <!-- Tabela resultados -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nome</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Código</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Ações</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($bancos) > 0)
                            @foreach($bancos as $banco)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $banco->nome }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                <h6 class="mb-0">{{ $banco->codigo }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $banco->status === 'ativo' ? 'success' : ($banco->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($banco->status) }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/banco/' . $banco->id) }}"
                                        class="btn btn-primary m-1" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/banco/' . $banco->id . '/edit') }}"
                                        class="btn btn-success m-1" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if($banco->status==='ativo')
                                    <a href="{{ url('admin/banco/inativar/' . $banco->id) }}"
                                        class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($banco->status==='inativo')
                                    <a href="{{ url('admin/banco/reativar/' . $banco->id) }}"
                                        class="btn btn-warning m-1" title="Reativar">
                                        <i class="ti ti-lock-off"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">Nenhum resultado encontrado.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection