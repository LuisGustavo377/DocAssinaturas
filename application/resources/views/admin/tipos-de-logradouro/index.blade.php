@extends ('layouts.main')

@section('title', 'Tipos de Logradouro')

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
                <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{ route('admin.tipos-de-logradouro.create') }}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulário da Barra de Pesquisa -->
                <form action="{{ route('admin.tipos-de-logradouro.search') }}" method="post">
                    @csrf
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search"
                            placeholder="Buscar por descrição...">
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
                                    <h6 class="mb-0 fw-semibold">Ações</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tipos_de_logradouro as $tipo)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">{{ $tipo->descricao }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/tipo-de-logradouro/' . $tipo->id) }}"
                                        class="m-1 btn btn-primary" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/tipo-de-logradouro/' . $tipo->id . '/edit') }}"
                                        class="m-1 btn btn-success" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Nenhum resultado encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $tipos_de_logradouro->links() }}

                </div>
            </div>
        </div>
    </div>

    @endsection