@extends ('layouts.main')

@section('title', 'Detalhar Tipo de Renovação')

@section('sidebar')
    <x-sidebar-admin></x-sidebar-admin>
@endsection

@section('navbar')
    <x-navbar-admin></x-navbar-admin>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4 card-title fw-semibold">@yield('title')</h5>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="#">
                            @csrf {{-- Prevenção do Laravel contra ataques a formulários --}}

                            <div class="alert alert-light">
                                <i class="ti ti-file-description" style="color: #13deb9"></i>
                                <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-12 col-md-12">
                                        <label id="descricaoLabel" class="form-label">Descrição</label>
                                        <input type="text" class="form-control @error('descricao') is-invalid @enderror"
                                            id="nomeInput" name="nome" value="{{ $tipo_de_renovacao->descricao }}" disabled>
                                    </div>
                                    
                                </div>
                            </div>
                    </div>

                    <div class="mb-3 d-flex justify-content-end">
                        <div class="mb-3">
                            <div class="my-4 text-center">
                                <a href="javascript:history.back()" class="btn btn-light me-2">
                                    <i class="ti ti-arrow-left me-1"></i>
                                    Voltar
                                </a>

                                <a href="{{ url('admin/tipo-de-renovacao/' . $tipo_de_renovacao->id . '/edit') }}" class="btn btn-success me-2">
                                    <i class="ti ti-edit me-1"></i>
                                    Editar
                                </a>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
