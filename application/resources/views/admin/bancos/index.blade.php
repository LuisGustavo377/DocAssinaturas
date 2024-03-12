@extends ('layouts.main')

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
            <div class="p-4 card-body">
                <div class="mb-4 d-flex justify-content-between align-items-center">
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
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar por nome do banco ou código...">
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
                                    <h6 class="mb-0 fw-semibold">Nome</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Código</h6>
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
                                        class="m-1 btn btn-primary" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/banco/' . $banco->id . '/edit') }}"
                                        class="m-1 btn btn-success" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if($banco->status==='ativo')
                                    <a href="{{ url('admin/banco/inativar/' . $banco->id) }}"
                                        class="m-1 btn btn-danger" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($banco->status==='inativo')
                                    <a href="{{ url('admin/banco/reativar/' . $banco->id) }}"
                                        class="m-1 btn btn-warning" title="Reativar">
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