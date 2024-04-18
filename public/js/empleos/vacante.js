document.addEventListener("DOMContentLoaded", function () {

    var fechaActual = new Date();
    var fechaVencimiento = new Date(document.getElementById('fecha_vencimiento').innerText);
    if (fechaVencimiento <= fechaActual) {
        document.getElementById('fecha_vencimiento').classList.add('fecha-vencida');
    }
});