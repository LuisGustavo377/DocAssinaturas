@extends ('layouts.dashboard')

@section('title', 'Criar Estabelecimento')

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
                    <h5 class="card-title fw-semibold">Estabelecimentos</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{route ('admin.estabelecimento.create')}}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulario da Barra de Pesquisa -->
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Buscar...">
                        <button class="btn btn-outline-success" type="submit">
                            <!-- Tabler Icons Search Icon -->
                            <i class="ti ti-search"></i>
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
                                    <h6 class="fw-semibold mb-0">Regime</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Telefone</h6>
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
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                                <td class="border-bottom-0">
                                <span class="badge bg-secondary rounded-3 fw-semibold">PF</span>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="fw-normal">Web Designer</span>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                                </td>
                                <td class="border-bottom-0">
                                    <!-- Add your action buttons (Detalhes, Editar, Inativar) with icons here -->
                                    <button class="btn btn-primary m-1" title="Detalhar">
                                    <i class="ti ti-search" ></i>
                                    </button>
                                    <button class="btn btn-success m-1" title="Editar">
                                    <i class="ti ti-edit" ></i>
                                    </button>
                                    <button class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock" ></i>
                                    </button>
                                </td>

                            </tr>
                            <!-- Repeat similar rows for other entries -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection