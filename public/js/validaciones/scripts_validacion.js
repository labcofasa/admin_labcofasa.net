// Función para mostrar la notificación personalizada
function showNotification(message) {
    const notification = document.getElementById('notification');
    const notificationText = document.getElementById('notification-text');
    notificationText.textContent = message;
    notification.classList.remove('hidden');

    document.getElementById('notification-close').addEventListener('click', function() {
        notification.classList.add('hidden');
    });

    // Oculta automáticamente después de 10 segundos
    setTimeout(() => {
        notification.classList.add('hidden');
    }, 10000);
}

// Función para validar los tipos de archivos permitidos
function validarArchivos() {
    document.querySelectorAll('input[type="file"].archivo-input').forEach(function(input) {
        input.addEventListener('change', function () {
            const allowedExtensions = ['pdf', 'jpg', 'png', 'jpeg'];
            const file = this.files[0]; // Obtiene el primer archivo seleccionado
            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                
                if (!allowedExtensions.includes(fileExtension)) {
                    // Mostrar notificación personalizada
                    showNotification('Solo se permiten archivos en formato PDF, JPG, PNG, o JPEG.');
                    this.value = ''; // Resetea el campo de archivo si la extensión no es válida
                }
            }
        });
    });
}

// Llama a la función de validación cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    validarArchivos();
});
