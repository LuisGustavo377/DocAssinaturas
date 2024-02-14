@extends('layouts.dashboard')

@section('title', 'Cargos')

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
                    <h5 class="card-title fw-semibold">@yield('title')</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{ route('admin.cargos.create') }}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulário da Barra de Pesquisa -->
                <form action="{{ route('admin.cargos.search') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search"
                            placeholder="Buscar por descricao...">
                        <button class="btn btn-outline-success" type="submit">
                            <i class="ti ti-search"></i>
                            Pesquisar
                        </button>
                    </div>
                </form>
                <!-- Tabela resultados -->
                <div class="table-responsive">
                    <table class="table mb-0 align-middle text-nowrap">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Descrição</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Status</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Ações</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cargos as $cargo)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">{{ $cargo->descricao }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $cargo->status === 'ativo' ? 'success' : ($cargo->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($cargo->status) }}
                                    </span>
                                </td>

                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/cargo/' . $cargo->id) }}"
                                        class="m-1 btn btn-primary" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/cargo/' . $cargo->id . '/edit') }}"
                                        class="m-1 btn btn-success" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if($cargo->status==='ativo')
                                    <a href="{{ url('admin/cargo/inativar/' . $cargo->id) }}"
                                        class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($cargo->status==='inativo')
                                    <a href="{{ url('admin/cargo/reativar/' . $cargo->id) }}"
                                        class="btn btn-warning m-1" title="Reativar">
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

                    {{ $cargos->links() }}

                </div>
            </div>
        </div>
    </div>

    @endsection