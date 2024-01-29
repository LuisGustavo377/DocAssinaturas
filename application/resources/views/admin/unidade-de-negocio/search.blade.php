@extends('layouts.dashboard')

@section('title', 'Resultados Pesquisa')

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
                    <h5 class="card-title fw-semibold">Resultados da Pesquisa: {{$termoPesquisa}}</h5>

                    <!-- Button to Create Establishment -->
                    <a href="javascript:history.back()" class="btn btn-outline-success">
                    <i class="ti ti-arrow-left me-1"></i>
                    Limpar Pesquisa
                </a>
                </div>

                @if ($resultados->isEmpty())

                <p>Não encontramos nenhum resultado em sua pesquisa <b>{{$termoPesquisa}}</b>. Por favor, tente
                    novamente.</p>

                @else

                <!-- Tabela resultados -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nome</h6>
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
                            @forelse($resultados as $resultado)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $resultado->nome }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $resultado->status === 'ativo' ? 'success' : ($resultado->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($resultado->status) }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/grupo-de-negocios/' . $resultado->id) }}"
                                        class="btn btn-primary m-1" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/grupo-de-negocios/' . $resultado->id . '/edit') }}"
                                        class="btn btn-success m-1" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    <button class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Nenhum resultado encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>

@endsection