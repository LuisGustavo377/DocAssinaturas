@extends('layouts.dashboard')

@section('title', 'Planos')

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
                <div class="p-4 card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="card-title fw-semibold">Planos</h5>

                        <!-- Button to Create Establishment -->
                        <a href="{{ route('admin.planos.create') }}" class="btn btn-success float-end">
                            <i class="ti ti-plus"></i>
                            Novo
                        </a>
                    </div>
                    <!-- Tabela resultados -->
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle text-nowrap">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Nome</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Valor</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="mb-0 fw-semibold">Ações</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($planos as $plano)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $plano->nome }}</h6>
                                        </td>

                                        <td class="border-bottom-0">
                                            <span
                                                class="badge bg-{{ $plano->status === 'ativo' ? 'success' : ($plano->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                                {{ ucfirst($plano->status) }}
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">{{ $plano->valor }}</h6>

                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ url('admin/plano/' . $plano->id) }}" class="m-1 btn btn-primary"
                                                title="Detalhar">
                                                <i class="ti ti-search"></i>
                                            </a>

                                            <a href="{{ url('admin/plano/' . $plano->id . '/edit') }}"
                                                class="m-1 btn btn-success" title="Editar">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            @if ($plano->status === 'ativo')
                                                <a href="{{ url('admin/plano/inativar/' . $plano->id) }}"
                                                    class="m-1 btn btn-danger" title="Inativar">
                                                    <i class="ti ti-lock"></i>
                                                </a>
                                            @elseif ($plano->status === 'inativo')
                                                <a href="{{ url('admin/plano/reativar/' . $plano->id) }}"
                                                    class="m-1 btn btn-warning" title="Reativar">
                                                    <i class="ti ti-lock-off"></i>
                                                </a>
                                            @endif
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

                </div>
            </div>
        </div>
    </div>

@endsection
