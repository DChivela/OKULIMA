<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Outras meta tags comuns -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="WAF Center - Domingos Chivela">
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
   <!-- No head do seu HTML -->
<meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua o Inputmask via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js" integrity="sha512-XgTXPMNq5bqzqJt7u7QqNLPKfjzOl+zXJbC4/RWBLBxTbS1Z4qTqQGPtuqDQ4V9cQ2/H8svhV2KxUyfs9XlE/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
    <a class="nav-link notification-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-chat-text"></i>
        <span class="navbar-badge badge text-bg-danger" id="notification-count">0</span>
    </a>
    
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" id="notification-container">
        <div class="dropdown-header bg-light p-2">
            <h6 class="m-0">Notificações</h6>
        </div>
        <ul id="dropdown-header bg-light p-2"></ul>
        <!-- As notificações serão inseridas aqui via JavaScript -->
        <div class="dropdown-footer text-center p-2">
            <button  class="d-none" id="read">Marcar todas como lido</button>
        </div>
    </div>

</li>
<!------------------------------------IMPORTANTEEE------------------------------------->
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
                                        <p>Pesquisas Gerais</p>
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
                                    <a href="{{ route('atividades-colheitas.index') }}" class="nav-link">
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
                                <p> Agendamentos <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                 
                                    <a href="{{ route('agendamentos.index') }}" class="nav-link">
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
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p> Utilizadores <i class="nav-arrow bi bi-chevron-right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Registar</p>
                                        
                                    </a>
                                    <!-- <p class="mb-0"> <a href="{{ route('register') }}" class="text-center"> Criar uma conta </a> </p> -->
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
            <div class="float-end d-none d-sm-inline">Soluções tecnológicas</div>
            <strong>Copyright &copy; {{ date('Y') }} &nbsp;<a href="https://www.wafcenter.com" class="text-decoration-none">WAF Center, Lda</a>.</strong>

            All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
    


<!-- No final do body, antes do fechamento -->

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












<!-- Your HTML file -->
<script>
async function fetchNotifications() {
  try {
    const response = await fetch('/notifications');
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const notifications = await response.json();
    displayNotifications(notifications);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

function displayNotifications(notifications) {
  const notificationsList = document.getElementById('dropdown-header bg-light p-2');
  const notificationCount = document.getElementById('notification-count');
  const markAsRead = document.getElementById('read');
  
  // Initialize displayedNotifications Set
  if (!window.displayedNotifications) {
    window.displayedNotifications = new Set();
  }
  
  
  // Clear existing notifications
  notificationsList.innerHTML = '';
  
  // Criar o modal HTML
  const modalHTML = `
    <div id="notificationsModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Notificações</h2>
          <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
          <ul id="modal-notifications-list"></ul>
        </div>
        <div class="modal-footer">
          <button id="modal-mark-all-read" class="btn btn-primary mb-3 mr-3">Marcar todas como lidas</button>
        </div>
      </div>
    </div>
  `;

  // Adicionar o modal ao body
  document.body.insertAdjacentHTML('beforeend', modalHTML);

  // Adicionar estilos CSS para o modal
  const modalStyles = `
    <style>
      .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
      }

      .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 800px;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 5px;
      }

      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }

      .close-modal {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
      }

      .close-modal:hover {
        color: black;
      }

      .modal-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #ddd;
        text-align: right;
      }

      #modal-notifications-list {
        list-style: none;
        padding: 0;
      }

      #modal-notifications-list li {
        padding: 10px;
        border-bottom: 1px solid #eee;
      }
         .view-more {
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
        cursor: pointer;
      }

      .view-more:hover {
        background-color: #e9ecef;
      }
    </style>
  `;

  // Adicionar os estilos ao head
  document.head.insertAdjacentHTML('beforeend', modalStyles);

  // Event listener para abrir o modal
  markAsRead.addEventListener('click', () => {
    const modal = document.getElementById('notificationsModal');
    const modalList = document.getElementById('modal-notifications-list');
    
    // Limpar lista atual do modal
    modalList.innerHTML = '';
    
    // Adicionar todas as notificações ao modal
    notifications.forEach(notification => {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>${notification.message}</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
      `;
      modalList.appendChild(listItem);
    });
    
    modal.style.display = 'block';
  });

  // Event listeners para fechar o modal
  document.querySelector('.close-modal').addEventListener('click', () => {
    document.getElementById('notificationsModal').style.display = 'none';
  });

  window.addEventListener('click', (event) => {
    const modal = document.getElementById('notificationsModal');
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });

  // Event listener para marcar todas como lidas
  document.getElementById('modal-mark-all-read').addEventListener('click', () => {
    // Aqui você pode adicionar a lógica para marcar todas as notificações como lidas
    displayedNotifications.clear();
    document.getElementById('notificationsModal').style.display = 'none';
    notificationsList.innerHTML = '';
    notificationCount.textContent = '0';
  });

  // Initial check
  checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications);

  // Check every minute
  setInterval(() =>
    checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications),
    60000
  );
}

function checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications) {
  const now = new Date();
  let displayCount=0;
  const maxDropdownNotifications = 6

  const sortedNotifications = notifications
  .filter(notification => 
      new Date(notification.data_hora) <= now && 
      !window.displayedNotifications.has(notification.id)
    )
    .sort((a, b) => new Date(b.data_hora) - new Date(a.data_hora));
  

  // Adicionar até 6 notificações mais recentes ao dropdown
  sortedNotifications.forEach(notification => {
    if (displayCount < maxDropdownNotifications) {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>Lembrete para a realização de uma tarefa agendada!</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
      `;
      
      notificationsList.appendChild(listItem);
      window.displayedNotifications.add(notification.id);
      displayCount++;
    }
  });
  
   // Se houver mais notificações, adicionar o botão "Ver todas"
   if (sortedNotifications.length > maxDropdownNotifications) {
    const viewMoreItem = document.createElement('div');
    viewMoreItem.className = 'view-more';
    viewMoreItem.innerHTML = `Ver todas as ${sortedNotifications.length} notificações`;
    viewMoreItem.onclick = () => {
      document.getElementById('read').click();
    };
    notificationsList.appendChild(viewMoreItem);
  }
  
  /*const actualNotifications = notificationsList.getElementsByTagName('li').length;
  notificationCount.textContent = actualNotifications.toString();*/
  // Atualizar o contador com o número total de notificações
  notificationCount.textContent = sortedNotifications.length.toString();
}

document.addEventListener('DOMContentLoaded', fetchNotifications);

//script funcional definitivo com problema na window.open function
/*async function fetchNotifications() {
  try {
    const response = await fetch('/notifications');
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const notifications = await response.json();
    displayNotifications(notifications);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

function displayNotifications(notifications) {
  const notificationsList = document.getElementById('dropdown-header bg-light p-2');
  const notificationCount = document.getElementById('notification-count');
  const markAsRead = document.getElementById('read');
  
  // Initialize displayedNotifications Set
  const displayedNotifications = new Set();
  
  // Clear existing notifications
  notificationsList.innerHTML = '';
  
  // Mark all as read
  markAsRead.addEventListener('click', () => {
   //Abrir uma nova janela com as notificaçoes
   const notificationWindow = window.open("", "Notificações", "width=800, height=600");
   notificationWindow.document.write(
     `<html>
       <head>
         <title>Notificações</title>
       </head>
        <body>
          <h1>Notificações</h1>
          <ul id="notification-lista"></ul>
          <button id="mark-all-read">Mark All as Read</button>

         
        
        </body>
      </html>
    `);
  });
  
  // Initial check
  checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications);
  
  // Check every minute
  setInterval(() => 
    checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications),
    60000
  );
}

function checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications) {
  const now = new Date();
  
  notifications.forEach(notification => {
    const notificationTime = new Date(notification.data_hora);
    
    // Check if notification should be displayed and hasn't been displayed yet
    if (
      notificationTime <= now && 
      !displayedNotifications.has(notification.id)
    ) {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>${notification.message}</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
      `;
      
      // Add new notification to the top of the list
      //if (notificationsList.firstChild) {
       // notificationsList.insertBefore(listItem, notificationsList.firstChild);
     // } else {
        notificationsList.appendChild(listItem);
     // }
      
      // Track displayed notification
      displayedNotifications.add(notification.id);
    }
  });
  
  // Update notification count based on actual list items
  const actualNotifications = notificationsList.getElementsByTagName('li').length;
  notificationCount.textContent = actualNotifications.toString();
}

document.addEventListener('DOMContentLoaded', fetchNotifications);*/
/*****************************************************************   */
//script funcional 3
/*async function fetchNotifications() {
  try {
    const response = await fetch('/notifications');
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const notifications = await response.json();
    displayNotifications(notifications);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

function displayNotifications(notifications) {
  const notificationsList = document.getElementById('dropdown-header bg-light p-2');
  const notificationCount = document.getElementById('notification-count');
  const markAsRead = document.getElementById('read');
  
  let displayedNotifications = new Set();
  //notificationCount.textCount = notificationsList.length
  // Mark all as read
  markAsRead.addEventListener('click', () => {
    notificationCount.textContent = "0";
  });
  
  // Display notifications based on date and time
  checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications);
  
  // Check every minute
  setInterval(() => 
    checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications), 
    60000
  );
}

function checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications) {
  const now = new Date();
  
  let newNotificationCount = 0;
  
  notifications.forEach(notification => {
    const notificationTime = new Date(notification.data_hora);
    
    // Verifica se a notificação está no tempo correto ou já passou do tempo
    // e ainda não foi exibida
    if (
      notificationTime <= now && // Verifica se já chegou ou passou do horário agendado
      !displayedNotifications.has(notification.id)
    ) {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>${notification.message}</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
         
      `;
      //<small>${new Date(notification.created_at).toLocaleString()}</small>
      // Adiciona nova notificação no topo da lista
      //if (notificationsList.firstChild) {
       // notificationsList.insertBefore(listItem, notificationsList.firstChild);
      //} else {
        notificationsList.appendChild(listItem);
      //}
      
      //displayedNotifications.add(notification.id);
      newNotificationCount++;
    }
  });
  
  // Atualiza o contador apenas se houver novas notificações
  if (newNotificationCount > 0) {
    // Conta o número real de itens na lista
    const actualNotifications = notificationsList.getElementsByTagName('li').length;
    notificationCount.textContent = actualNotifications.toString();
  }
}

// Call the fetchNotifications function when the page is loaded
document.addEventListener('DOMContentLoaded', fetchNotifications);

// Opcional: Atualizar notificações quando a página voltar do background
/*document.addEventListener('visibilitychange', () => {
  if (!document.hidden) {
    fetchNotifications();
  }
});*/

//script 2 funcional
/*async function fetchNotifications() {
  try {
    const response = await fetch('/notifications'); // Adjust the URL if necessary
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const notifications = await response.json();
    displayNotifications(notifications);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

function displayNotifications(notifications) {
  const notificationsList = document.getElementById('dropdown-header bg-light p-2');
  const notificationCount = document.getElementById('notification-count');
  const markAsRead = document.getElementById('read');

  let displayedNotifications = new Set();

  // Initially, display all loaded notifications
  notificationsList.innerHTML = '';
  notificationCount.textContent = notifications.length;

  // Mark all as read
  markAsRead.addEventListener('click', () => {
    notificationCount.textContent = "0";
  });

  // Display notifications based on date and time
  checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications);

  // Check every minute
  setInterval(() => checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications), 60000); // 60000 ms = 1 minute
}

function checkDateAndTime(notifications, notificationsList, notificationCount, displayedNotifications) {
  const now = new Date();
  const currentDate = now.toISOString().slice(0, 10);
  const currentHours = now.getHours();
  const currentMinutes = now.getMinutes();

  let newNotificationCount = 0;
  notifications.forEach(notification => {
    const notificationDate = new Date(notification.data_hora).toISOString().slice(0, 10);
    const notificationHours = new Date(notification.data_hora).getHours();
    const notificationMinutes = new Date(notification.data_hora).getMinutes();

    // Check if the notification matches the current date and time and hasn't been displayed yet
    if (
      notificationDate === currentDate &&
      notificationHours === currentHours &&
      notificationMinutes === currentMinutes &&
      !displayedNotifications.has(notification.id) // Ensure the notification hasn't been displayed
    ) {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>${notification.message}</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
      `;
      notificationsList.appendChild(listItem);
      displayedNotifications.add(notification.id); // Mark this notification as displayed
      newNotificationCount++;
    }
  });

  notificationCount.textContent = newNotificationCount;
}

// Call the fetchNotifications function when the page is loaded
document.addEventListener('DOMContentLoaded', fetchNotifications);*/


/**************************************************** */
   //Script funcional
   /*async function fetchNotifications() {
  try {
    const response = await fetch('/notifications'); // Adjust the URL if necessary
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const notifications = await response.json();
    displayNotifications(notifications);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
}

function displayNotifications(notifications) {
  const notificationsList = document.getElementById('dropdown-header bg-light p-2');
  const notificationCount = document.getElementById('notification-count');
  const markAsRead = document.getElementById('read');

  // Initially, display all loaded notifications
  notificationsList.innerHTML = '';
  notificationCount.textContent = notifications.length;

  // Mark all as read
  markAsRead.addEventListener('click', () => {
    notificationCount.textContent = "0";
  });

  // Display only notifications with date and time corresponding to the current date and time
  checkDateAndTime(notifications, notificationsList, notificationCount);

  // Check every minute
  setInterval(() => checkDateAndTime(notifications, notificationsList, notificationCount), 60000); // 60000 ms = 1 minute
}

function checkDateAndTime(notifications, notificationsList, notificationCount) {
  const now = new Date();
  const currentDate = now.toISOString().slice(0, 10);
  const currentHours = now.getHours();
  const currentMinutes = now.getMinutes();

  // Clear the notification list before adding the new ones
  notificationsList.innerHTML = '';

  let newNotificationCount = 0;
  notifications.forEach(notification => {
    const notificationDate = new Date(notification.data_hora).toISOString().slice(0, 10);
    const notificationHours = new Date(notification.data_hora).getHours();
    const notificationMinutes = new Date(notification.data_hora).getMinutes();

    if (notificationDate === currentDate && notificationHours === currentHours && notificationMinutes === currentMinutes) {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <strong>${notification.title}</strong>
        <p>${notification.message}</p>
        <small>${new Date(notification.data_hora).toLocaleString()}</small>
      `;
      notificationsList.appendChild(listItem);
      newNotificationCount++;
    }
  });

  notificationCount.textContent = newNotificationCount;
}

// Call the fetchNotifications function when the page is loaded
document.addEventListener('DOMContentLoaded', fetchNotifications);*/
</script>



</body>

</html>
