@extends ('layouts.dashboard')

@section('title', 'Grupo de Negócios')

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
                    <h5 class="card-title fw-semibold">Grupo de Negócios</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{route ('admin.grupo-de-negocios.create')}}" class="btn btn-success float-end">
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
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Ações</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($grupos) && count($grupos) > 0)
                            @foreach($grupos as $grupo)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $grupo->nome }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    @if($grupo->status == 'ativo')
                                    <span class="badge bg-success rounded-3 fw-semibold">Ativo</span>
                                    @elseif($grupo->status == 'inativo')
                                    <span class="badge bg-danger rounded-3 fw-semibold">Inativo</span>
                                    @else
                                    <span class="badge bg-warning rounded-3 fw-semibold">Bloqueado</span>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    <button class="btn btn-primary m-1" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </button>
                                    <button class="btn btn-success m-1" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Nenhum resultado encontrado.</td>
                            </tr>
                            @endif
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection