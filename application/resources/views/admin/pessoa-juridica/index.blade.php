@extends ('layouts.main')

@section('title', 'Pessoa Jurídica')

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
                    <h5 class="card-title fw-semibold">Pessoa Jurídica</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{ route('admin.pessoa-juridica.create') }}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulário da Barra de Pesquisa -->
                <form action="{{ route('admin.pessoa-juridica.search') }}" method="post">
                    @csrf
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search"
                            placeholder="Buscar por Razão Social, Nome Fantasia ou CNPJ...">
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
                                    <h6 class="mb-0 fw-semibold">Razão Social</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">CNPJ</h6>
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
                            @if(count($pessoas) > 0)
                            @foreach($pessoas as $pessoa)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $pessoa->razao_social }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">
                                        {{ substr($pessoa->cnpj, 0, 2) }}.{{ substr($pessoa->cnpj, 2, 3) }}.{{ substr($pessoa->cnpj, 5, 3) }}/{{ substr($pessoa->cnpj, 8, 4) }}-{{ substr($pessoa->cnpj, 12, 2) }}
                                    </h6>
                                </td>


                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $pessoa->status === 'ativo' ? 'success' : ($pessoa->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($pessoa->status) }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/pessoa-juridica/' . $pessoa->id) }}"
                                        class="m-1 btn btn-primary" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/pessoa-juridica/' . $pessoa->id . '/edit') }}"
                                        class="m-1 btn btn-success" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if($pessoa->status==='ativo')
                                    <a href="{{ url('admin/pessoa-juridica/inativar/' . $pessoa->id) }}"
                                        class="m-1 btn btn-danger" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($pessoa->status==='inativo')
                                    <a href="{{ url('admin/pessoa-juridica/reativar/' . $pessoa->id) }}"
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
                    {{ $pessoas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection