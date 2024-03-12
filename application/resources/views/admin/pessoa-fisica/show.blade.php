@extends ('layouts.main')

@section('title', 'Detalhar Pessoa Fisica')

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
                    <div class="alert alert-light">
                        <i class="ti ti-user" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="mb-6 col-md-6">
                                <label id="nomeLabel" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                    id="nomeInput" name="nome" placeholder="Nome" value="{{ $pessoa->nome  }}" disabled>
                            </div>
                            <div class="mb-6 col-md-6">
                                <label id="cpfLabel" class="form-label">CPF</label>
                                <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpfInput"
                                    name="cpf" placeholder="CPF"
                                    value="{{ sprintf("%s.%s.%s-%s", substr($pessoa->cpf, 0, 3), substr($pessoa->cpf, 3, 3), substr($pessoa->cpf, 6, 3), substr($pessoa->cpf, 9, 2)) }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light">
                        <i class="ti ti-message" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Contato</label>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="mb-6 col-md-6">
                                <label class="form-label">Telefone</label>
                                @foreach ($pessoa->telefones as $telefone)
                                <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                    class="form-control telefone" id="telefoneInput" name="telefone"
                                    placeholder="Telefone" value="{{ $telefone->telefone }}" disabled>
                                @endforeach
                            </div>

                            <div class="mb-6 col-md-6">

                                <label id="emailLabel" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="emailInput" name="email" placeholder="Email" value="{{ $pessoa->email  }}"
                                    disabled>
                            </div>
                        </div>
                    </div>


                    <div class="alert alert-light">
                        <i class="ti ti-address-book" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Endereço</label>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label id="logradouroLabel" class="form-label">Logradouro</label>
                            <input type="text" class="form-control" id="logradouroInput" name="logradouro"
                                placeholder="Logradouro"
                                value="{{ $pessoa->enderecos->first()->tipoDeLogradouro->descricao . ' ' . $pessoa->enderecos->first()->logradouro }}"
                                disabled>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label id="numeroLabel" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numeroInput" name="numero"
                                    placeholder="Número" value="{{ $pessoa->enderecos->first()->numero }}" disabled>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label id="complementoLabel" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complementoInput" name="complemento"
                                    placeholder="Complemento" value="{{ $pessoa->enderecos->first()->complemento }}"
                                    disabled>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label id="bairroLabel" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairroInput" name="bairro"
                                    placeholder="Bairro" value="{{ $pessoa->enderecos->first()->bairro }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="estadoSelect" class="form-label">Estado</label>
                                <input type="text" class="form-control"
                                    value="{{ $pessoa->enderecos->first()->estado->nome }}" disabled>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cidadeSelect" class="form-label">Cidade</label>
                                <input type="text" class="form-control"
                                    value="{{ $pessoa->enderecos->first()->cidade->nome }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light">
                        <i class="ti ti-photo" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Imagem</label>
                    </div>


                    <div class="mb-3">
                        <div class="card">
                            <div class="text-left card-body">
                                @if ($pessoa->imagem === 'imagem_padrao')
                                <img src="{{ asset('assets/images/profile/imagem_user.svg') }}" width="200" height="200"
                                    class="rounded img-fluid" alt="Imagem Padrão">
                                @else
                                <img src="{{ asset('img/pessoaFisica/' . $pessoa->imagem) }}" class="rounded img-fluid"
                                    width="200" height="200">
                                @endif
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
                                <a href="{{ url('admin/pessoa-fisica/' . $pessoa->id . '/edit') }}"
                                    class="btn btn-success me-2">
                                    <i class="ti ti-edit me-1"></i>
                                    Editar
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection