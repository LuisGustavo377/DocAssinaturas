<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="cursor-pointer close-btn d-xl-none d-block sidebartoggler" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">FUNÇÕES</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/grupo-de-negocios" aria-expanded="false">
                        <span>
                            <i class="ti ti-circles-relation"></i>
                        </span>
                        <span class="hide-menu">Grupos de Negócio</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/unidade-de-negocios">
                        <span>
                            <i class="ti ti-components"></i>
                        </span>
                        <span class="hide-menu">Unidades de Negócio</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Cadastro de Pessoas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- Submenu for Pessoa Fisica -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/pessoa-fisica">
                                <span class="hide-menu">
                                    - Pessoa Física
                                </span>
                            </a>
                        </li>
                        <!-- Submenu for Pessoa Juridica -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/pessoa-juridica">
                                <span class="hide-menu">
                                    - Pessoa Jurídica
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-certificate"></i>
                        </span>
                        <span class="hide-menu">Licenciamento</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <ul class="sidebar-item">
                            <li>
                                <a class="sidebar-link" href="/admin/contratos">
                                    <span class="hide-menu">
                                        - Contratos
                                    </span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a class="sidebar-link" href="/admin/contratos/gerar-documento">
                                            <span class="hide-menu">
                                                -- Gerar Documento
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="/admin/contratos/novo-contrato">
                                            <span class="hide-menu">
                                                -- Novo Contrato
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>


                        <!-- Submenu for Licenças -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/licencas">
                                <span class="hide-menu">
                                    - Licenças
                                </span>
                            </a>
                        </li>

                        <!-- Submenu for Planos -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/planos">
                                <span class="hide-menu">
                                    - Planos
                                </span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-tool"></i>
                        </span>
                        <span class="hide-menu">Configurações</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <!-- Submenu for Planos -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/bancos">
                                <span class="hide-menu">
                                    - Bancos
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/cargos">
                                <span class="hide-menu">
                                    - Cargos
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/contas-bancarias">
                                <span class="hide-menu">
                                    - Contas Bancárias
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/tipos-de-cobranca">
                                <span class="hide-menu">
                                    - Tipos de Cobrança
                                </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/tipos-de-logradouro">
                                <span class="hide-menu">
                                    - Tipos de Logradouro
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/tipos-de-relacionamentos">
                                <span class="hide-menu">
                                    - Tipos de Relacionamento
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/admin/tipos-de-renovacao">
                                <span class="hide-menu">
                                    - Tipos de Renovação
                                </span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>