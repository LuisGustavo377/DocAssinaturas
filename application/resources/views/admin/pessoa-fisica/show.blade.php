
@extends('layouts.dashboard')

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
            <h5 class="card-title fw-semibold mb-4">@yield('title')</h5>
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-light">
                        <i class="ti ti-user" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Dados Cadastrais</label>
                    </div>



                    <div class="card-body">
                        <div class="mb-3">
                            <label id="nomeLabel" class="form-label">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nomeInput"
                                name="nome" placeholder="Nome" value="{{ $pessoa->nome  }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label id="cpfLabel" class="form-label">CPF</label>
                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpfInput"
                                name="cpf" placeholder="CPF" value="{{ $pessoa->cpf }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="tel" oninput="mascaraTelefone(this)" maxlength="15"
                                class="form-control telefone @error('telefone') is-invalid @enderror" id="telefoneInput"
                                name="telefone" placeholder="Telefone" value="{{ $pessoa->telefone}}" disabled>
                        </div>

                        <div class="mb-3">
                            <label id="emailLabel" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="emailInput" name="email" placeholder="Email" value="{{ $pessoa->email  }}" disabled>
                        </div>
                    </div>



                    <div class="alert alert-light">
                        <i class="ti ti-address-book" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Endereço</label>
                    </div>

                    <div class="card-body">



                        <div class="mb-3">
                            <label id="logradouroLabel" class="form-label">Logradouro</label>
                            <input type="text" class="form-control @error('logradouro') is-invalid @enderror"
                                id="logradouroInput" name="logradouro" placeholder="Logradouro"
                                value="{{ $pessoa->tipo_de_logradouro . ' ' . $pessoa->logradouro }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label id="numeroLabel" class="form-label">Número</label>
                            <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                id="numeroInput" name="numero" placeholder="Número" value="{{ $pessoa->numero }}"
                                disabled>
                        </div>

                        <div class="mb-3">
                            <label id="complementoLabel" class="form-label">Complemento</label>
                            <input type="text" class="form-control @error('complemento') is-invalid @enderror"
                                id="complementoInput" name="complemento" placeholder="Complemento"
                                value="{{ $pessoa->complemento  }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label id="bairroLabel" class="form-label">Bairro</label>
                            <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                id="bairroInput" name="bairro" placeholder="Bairro" value="{{ $pessoa->bairro}}"
                                disabled>
                        </div>

                        <div class="mb-3">
                            <label for="estadoSelect" class="form-label">Estado</label>
                            <input type="text" class="form-control" value="{{$pessoa->estado->nome}}" disabled></input>
                        </div>

                        <div class="mb-3">
                            <label for="cidadeSelect" class="form-label">Cidade</label>
                            <input type="text" class="form-control" value="{{$pessoa->cidade->nome}}" disabled></input>

                        </div>

                    </div>

                    <div class="alert alert-light">
                        <i class="ti ti-photo" style="color: #13deb9"></i>
                        <label class="form-label" style="color: #13deb9">Imagem</label>
                    </div>


                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body text-left">
                                

                                @if ($pessoa->imagem === 'imagem_padrao')
                                <img src="{{ asset('assets/images/profile/imagem_user.svg') }}" width="500" height="500"
                                    class="img-fluid rounded" alt="Imagem Padrão">
                                @else
                                <img src="{{ asset('img/pessoaFisica/' . $pessoa->imagem) }}"
                                    class="img-fluid rounded" width="500" height="500">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>



                <div class="mb-3 d-flex justify-content-end">
                    <div class="mb-3">
                        <div class="text-center my-4">
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