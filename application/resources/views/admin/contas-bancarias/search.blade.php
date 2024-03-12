@extends ('layouts.main')

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
                <div class="p-4 card-body">

                    <div class="alert alert-light d-flex justify-content-between align-items-center">
                        <div>
                            <i class="ti ti-search" style="color: #13deb9"></i>
                            <label class="form-label" style="color: #13deb9">Resultados da Pesquisa:
                                <span style="color: #5A6A85">{{ $termoPesquisa }}</span></label>
                        </div>
                    </div>

                    @if (!$unidade)

                        <p>Unidade com nome <b>{{ $termoPesquisa }}</b> é inválida. Por favor, tente novamente.</p>
                    @elseif ($resultados->isEmpty())
                        <p>Não encontramos nenhum resultado em sua pesquisa <b>{{ $termoPesquisa }}</b>. Por favor, tente
                            novamente.</p>
                    @else
                        <!-- Tabela resultados -->
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle text-nowrap">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold">Unidade</h6>
                                        </th>

                                        <th class="border-bottom-0">
                                            <h6 class="mb-0 fw-semibold"> Banco</h6>
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
                                    @if (count($resultados) > 0)
                                        @foreach ($resultados as $resultado)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    @if ($resultado->unidadeDeNegocio->tipo_pessoa == 'pf')
                                                        <h6 class="mb-0 fw">
                                                            {{ $resultado->unidadeDeNegocio->pessoaFisica->nome }}</h6>
                                                    @else
                                                        <h6 class="mb-0 fw">
                                                            {{ $resultado->unidadeDeNegocio->pessoaJuridica->razao_social }}
                                                        </h6>
                                                    @endif
                                                </td>

                                                <td class="border-bottom-0">
                                                    @if ($resultado->banco)
                                                        <h6 class="mb-0 fw">{{ $resultado->banco->nome }}</h6>
                                                    @else
                                                        <h6 class="mb-0 fw">n/a</h6>
                                                    @endif

                                                </td>
                                                <td class="border-bottom-0">
                                                    <span
                                                        class="badge bg-{{ $resultado->status === 'ativo' ? 'success' : ($resultado->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                                        {{ ucfirst($resultado->status) }}
                                                    </span>
                                                </td>

                                                <td class="border-bottom-0">
                                                    <a href="{{ url('admin/conta-bancaria/' . $resultado->id) }}"
                                                        class="m-1 btn btn-primary" title="Detalhar">
                                                        <i class="ti ti-search"></i>
                                                    </a>

                                                    <a href="{{ url('admin/conta-bancaria/' . $resultado->id . '/edit') }}"
                                                        class="m-1 btn btn-success" title="Editar">
                                                        <i class="ti ti-edit"></i>
                                                    </a>

                                                    @if ($resultado->status === 'ativo')
                                                        <a href="{{ url('admin/conta-bancaria/inativar/' . $resultado->id) }}"
                                                            class="m-1 btn btn-danger" title="Inativar">
                                                            <i class="ti ti-lock"></i>
                                                        </a>
                                                    @elseif ($resultado->status === 'inativo')
                                                        <a href="{{ url('admin/conta-bancaria/reativar/' . $resultado->id) }}"
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
                    @endif

                    <div class="mb-3 d-flex justify-content-end">
                        <div class="mb-3">
                            <div class="my-4 text-center">
                                <a href="javascript:history.back()" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i>
                                    Voltar
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

@endsection
