<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Outras meta tags comuns -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="QUIALA - Marcas de sucessos">
    <meta name="keywords" content="gestão agrícola, Okulima, agricultura, software">
    <link rel="icon" href="{{ asset('assets/img/logo/icon.png') }}" type="image/x-icon">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://okulima-software.com/">
    <meta property="og:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="og:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="og:image" content="{{ asset('assets/img/logo/icon.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://okulima-software.com/">
    <meta property="twitter:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="twitter:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="twitter:image" content="{{ asset('assets/img/logo/icon.png') }}">

    <!-- LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://okulima-software.com/">
    <meta property="og:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="og:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="og:image" content="{{ asset('assets/img/logo/icon.png') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i> </a> </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i> <span class="navbar-badge badge text-bg-danger">3</span>
                        </a>
                        {{-- Aqui deve ser colocada as notificações --}}
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title"> Brad Diesel <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span> </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary"> <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago </p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/img/logo/icon.png') }}" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{
                            // Quero apenas o primeiro nome antes do espaçamento
                            str_replace(' ', '', Auth::user()->name)
                            }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('assets/img/logo/icon-vector.png') }}" class="rounded-circle shadow" alt="User Image">
                                <p>{{ Auth::user()->name }}</p>
                                <p><small>Registado em {{
                                    \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y')
                                 }}</small> </p>
                            </li>
                            {{-- <li class="user-body">
                                <div class="row">
                                    <div class="col-6 text-center"> <a href="#">Seus dados</a> </div>
                                    <div class="col-6 text-center"> <a href="#">Definições do Sistema</a> </div>
                                </div>
                            </li> --}}
                            <li class="user-footer">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger form-control"><i class="bi bi-box-arrow-in-right"></i> Terminar sessão</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="/" class="brand-link">
                    <img src="{{ asset('assets/img/logo/icon-vector.png') }}" alt="OKULIMA LOGO" class="brand-image opacity-75 shadow"  width="10%">
                   <span class="brand-text fw-light">OKULIMA</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Painel <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/home" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Estatísticas</p>
                                    </a>
                                    <a href="/search" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Pesquisas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Trabalhadores <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/create-trabalhador" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Trabalhador</p>
                                    </a>
                                    <a href="/list-trabalhador" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Trabalhadores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Equipamentos <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/create-equipamento" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Equipamento</p>
                                    </a>
                                    <a href="/list-equipamento" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Equipamentos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Fazendas <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('fazendas.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Fazenda</p>
                                    </a>
                                    <a href="{{ route('fazendas.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Fazendas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Campos de cultivo <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('campos-cultivo.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Campo</p>
                                    </a>
                                    <a href="{{ route('campos-cultivo.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Campos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Posto de Abastecimento <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('abastecimentos.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Posto</p>
                                    </a>
                                    <a href="{{ route('abastecimentos.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Postos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Máquinas <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('atividades-maquinas.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Máquina</p>
                                    </a>
                                    <a href="{{ route('atividades-maquinas.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Máquinas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Colheitas <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('atividades-colheitas.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar Colheita</p>
                                    </a>
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar Colheitas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Atividades de Trabalhadores <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('atividades-trabalhador.create') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar</p>
                                    </a>
                                    <a href="{{ route('atividades-trabalhador.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Produtos <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('produtos.index') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar / Listar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Lugares <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/localizacoes" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar / Ver</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="app-main">

            @yield('content')

        </main>
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <strong>Copyright &copy; {{ date('Y') }} &nbsp;<a href="https://quialacorps.com" class="text-decoration-none">QUIALA</a>.</strong>

            All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
</body>

</html>
