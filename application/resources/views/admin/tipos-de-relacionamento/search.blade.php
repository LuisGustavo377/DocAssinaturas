@extends('layouts.dashboard')

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
            <div class="card-body p-4">

                <div class="alert alert-light d-flex justify-content-between align-items-center">
                    <div>
                        <i class="ti ti-search" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Resultados da Pesquisa:
                            {{$termoPesquisa}}</label>
                    </div>
                </div>

                @if ($resultados->isEmpty())

                <p>Não encontramos nenhum resultado em sua pesquisa <b>{{$termoPesquisa}}</b>. Por favor, tente
                    novamente.</p>

                @else

                <!-- Tabela resultados -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Descrição</h6>
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
                            @if(count($resultados) > 0)
                            @foreach($resultados as $resultado)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="mb-0">{{ $resultado->descricao }}</h6>
                                </td>

                                <td class="border-bottom-0">
                                    <span
                                        class="badge bg-{{ $resultado->status === 'ativo' ? 'success' : ($resultado->status === 'inativo' ? 'danger' : 'warning') }} rounded-3 fw-semibold">
                                        {{ ucfirst($resultado->status) }}
                                    </span>
                                </td>

                                <td class="border-bottom-0">
                                    <a href="{{ url('admin/tipo-de-relacionamento/' . $resultado->id) }}"
                                        class="btn btn-primary m-1" title="Detalhar">
                                        <i class="ti ti-search"></i>
                                    </a>

                                    <a href="{{ url('admin/tipo-de-relacionamento/' . $resultado->id . '/edit') }}"
                                        class="btn btn-success m-1" title="Editar">
                                        <i class="ti ti-edit"></i>
                                    </a>

                                    @if($resultado->status==='ativo')
                                    <a href="{{ url('admin/tipo-de-relacionamento/inativar/' . $resultado->id) }}"
                                        class="btn btn-danger m-1" title="Inativar">
                                        <i class="ti ti-lock"></i>
                                    </a>
                                    @elseif ($resultado->status==='inativo')
                                    <a href="{{ url('admin/tipo-de-relacionamento/reativar/' . $resultado->id) }}"
                                        class="btn btn-warning m-1" title="Reativar">
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
                        <div class="text-center my-4">
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