// resources/js/notifications.js
document.addEventListener('DOMContentLoaded', function() {
    const notificationContainer = document.getElementById('notification-container');
    const notificationCount = document.getElementById('notification-count');
    const dropdownHeader = `
        <div class="dropdown-header bg-light p-2">
            <h6 class="m-0">Notificações</h6>
        </div>
    `;
    const dropdownFooter = `
        <div class="dropdown-footer text-center p-2">
            <a href="#" class="text-decoration-none">Ver todas as mensagens</a>
        </div>
    `;

    function formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = now - date;
        
        // Menos de 1 minuto
        if (diff < 60000) {
            return 'Agora mesmo';
        }
        // Menos de 1 hora
        if (diff < 3600000) {
            const minutes = Math.floor(diff / 60000);
            return `${minutes} ${minutes === 1 ? 'minuto' : 'minutos'} atrás`;
        }
        // Menos de 1 dia
        if (diff < 86400000) {
            const hours = Math.floor(diff / 3600000);
            return `${hours} ${hours === 1 ? 'hora' : 'horas'} atrás`;
        }
        // Mais de 1 dia
        const days = Math.floor(diff / 86400000);
        return `${days} ${days === 1 ? 'dia' : 'dias'} atrás`;
    }

    function updateNotifications() {
        console.log('Buscando notificações...');

        fetch('/notifications', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            console.log('Dados recebidos:', data);

            // Atualiza o contador
            if (data.unreadCount > 0) {
                notificationCount.textContent = data.unreadCount;
                notificationCount.style.display = 'inline';
            } else {
                notificationCount.style.display = 'none';
            }

            // Prepara o conteúdo das notificações
            let notificationsHtml = dropdownHeader;

            if (data.notifications && data.notifications.length > 0) {
                data.notifications.forEach(notification => {
                    notificationsHtml += `
                        <div class="dropdown-item" data-notification-id="${notification.id}">
                            <div class="d-flex align-items-start py-2">
                                <div class="flex-shrink-0">
                                    <img src="/assets/img/logoWAF.jpg" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">${notification.title}</h6>
                                    <p class="mb-1 text-muted small">${notification.message}</p>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        ${formatDate(notification.created_at)}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    `;
                });
            } else {
                notificationsHtml += `
                    <div class="dropdown-item text-center py-3">
                        <p class="text-muted mb-0">Nenhuma notificação</p>
                    </div>
                `;
            }

            notificationsHtml += dropdownFooter;
            notificationContainer.innerHTML = notificationsHtml;

            // Adiciona event listeners para as notificações
            const notificationItems = notificationContainer.querySelectorAll('[data-notification-id]');
            notificationItems.forEach(item => {
                item.addEventListener('click', handleNotificationClick);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar notificações:', error);
            notificationContainer.innerHTML = `
                ${dropdownHeader}
                <div class="dropdown-item text-center py-3">
                    <p class="text-danger mb-0">Erro ao carregar notificações</p>
                </div>
                ${dropdownFooter}
            `;
        });
    }

    function handleNotificationClick(e) {
        e.preventDefault();
        const notificationId = this.dataset.notificationId;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            console.log('Notificação marcada como lida:', data);
            // Atualiza a lista de notificações
            updateNotifications();
        })
        .catch(error => {
            console.error('Erro ao marcar notificação como lida:', error);
        });
    }

    // Inicia a atualização das notificações
    updateNotifications();
    
    // Atualiza a cada 30 segundos
    setInterval(updateNotifications, 30000);
});