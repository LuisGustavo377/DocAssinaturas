@extends ('layouts.main')

@section('title', 'Usuários')

@section('sidebar')
<x-sidebar-proprietario></x-sidebar-proprietario>
@endsection

@section('navbar')
<x-navbar-proprietario></x-navbar-proprietario>
@endsection


@section('content')

<div class="container-fluid">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="p-4 card-body">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold">Gerenciar Usuários</h5>

                    <!-- Button to Create Establishment -->
                    <a href="{{ route('proprietario.user.create') }}" class="btn btn-success float-end">
                        <i class="ti ti-plus"></i>
                        Novo
                    </a>
                </div>

                <!-- Formulário da Barra de Pesquisa -->
                <form action="{{ route('proprietario.user.search') }}" method="post">
                    @csrf
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar usuário por nome...">
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
                                    <h6 class="mb-0 fw-semibold">CPF</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Email</h6>
                                </th>

                                <th class="border-bottom-0">
                                    <h6 class="mb-0 fw-semibold">Tipo de Usuário</h6>
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
                            @if (count($users) > 0)
                            @foreach ($users as $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">
                                        {{ sprintf("%s.%s.%s-%s", substr($user->cpf, 0, 3), substr($user->cpf, 3, 3), substr($user->cpf, 6, 3), substr($user->cpf, 9, 2)) }}
                                    </h6>
                                </td>

                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $user->email }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $user->tipo_de_usuario }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $user->status === 'ativo' ? 'success' : ($user->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <a href="{{ url('proprietario/user/' . $user->id) }}" class="m-1 btn btn-primary"
                                        title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('proprietario/user/' . $user->id . '/edit') }}"
                                        class="m-1 btn btn-success" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if ($user->status === 'ativo')
                                    <a href="{{ url('proprietario/user/inativar/' . $user->id) }}"
                                        class="m-1 btn btn-danger" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($user->status === 'inativo')
                                    <a href="{{ url('proprietario/user/reativar/' . $user->id) }}"
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