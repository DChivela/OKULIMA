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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://okulima-software.com/">
    <meta property="og:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="og:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="og:image" content="../dist/img/logo/icon-2.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://okulima-software.com/">
    <meta property="twitter:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="twitter:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="twitter:image" content="../dist/img/logo/icon-2.png">

    <!-- LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://okulima-software.com/">
    <meta property="og:title" content="Okulima - Sistema de Gestão Agrícola Inteligente">
    <meta property="og:description" content="Simplifique o gerenciamento agrícola com o Okulima">
    <meta property="og:image" content="../dist/img/logo/icon-2.png">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="login-page bg-body-secondary" style="background-image: url('https://i.pinimg.com/originals/d5/69/12/d56912e297cf3a797d5d5c728a23fda9.gif'); background-repeat: no-repeat; background-size: cover; background-position: center">
    <div class="login-box">
        <p class="text-center"><img src="{{ asset('assets/img/logo/logo-1.png') }}" alt="" class="okulima-logo" width="50%" ></p>

        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
    <script src="../../../dist/js/adminlte.js"></script>
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
