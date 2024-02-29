@extends('layouts.dashboard')

@section('title', 'Unidade de Negócios')

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
                        <h5 class="card-title fw-semibold">Unidade de Negócios</h5>

                        <!-- Button to Create Establishment -->
                        <a href="{{ route('admin.unidade-de-negocio.create') }}" class="btn btn-success float-end">
                            <i class="ti ti-plus"></i>
                            Novo
                        </a>
                    </div>

                    <!-- Formulário da Barra de Pesquisa -->
                    <form action="{{ route('admin.unidade-de-negocio.search') }}" method="post">
                        @csrf
                        <div class="mb-3 input-group">
                            <input type="text" class="form-control" name="search" placeholder="Buscar...">
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
                                        <h6 class="mb-0 fw-semibold">Nome/Razão Social</h6>
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
                                @forelse($unidades as $unidade)
                                    <tr>


                                        <td class="border-bottom-0">
                                            <h6 class="mb-0">{{ $unidade->NomeOuRazaoSocial }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <span
                                                class="badge bg-{{ $unidade->status === 'ativo' ? 'success' : ($unidade->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                                {{ ucfirst($unidade->status) }}
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <a href="{{ url('admin/unidade-de-negocio/' . $unidade->id) }}"
                                                class="m-1 btn btn-primary" title="Detalhar">
                                                <i class="ti ti-search"></i>
                                            </a>

                                            <a href="{{ url('admin/unidade-de-negocio/' . $unidade->id . '/edit') }}"
                                                class="m-1 btn btn-success" title="Editar">
                                                <i class="ti ti-edit"></i>
                                            </a>

                                            @if ($unidade->status === 'ativo')
                                                <a href="{{ url('admin/unidade-de-negocio/inativar/' . $unidade->id) }}"
                                                    class="m-1 btn btn-danger" title="Inativar">
                                                    <i class="ti ti-lock"></i>
                                                </a>
                                            @elseif ($unidade->status === 'inativo')
                                                <a href="{{ url('admin/unidade-de-negocio/reativar/' . $unidade->id) }}"
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
                        {{ $unidades->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
