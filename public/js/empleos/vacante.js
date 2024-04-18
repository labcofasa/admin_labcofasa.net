document.addEventListener("DOMContentLoaded", function () {

    var fechaActual = new Date();
    var fechaVencimiento = new Date(document.getElementById('fecha_vencimiento').innerText);
    if (fechaVencimiento <= fechaActual) {
        document.getElementById('fecha_vencimiento').classList.add('fecha-vencida');
    }

    var fechaVencimientoString = document.getElementById('fecha_vencimiento').innerText;
    var fechaVencimiento = new Date(fechaVencimientoString);
    var dia = fechaVencimiento.getDate();
    var mes = fechaVencimiento.getMonth() + 1;
    var año = fechaVencimiento.getFullYear();
    var fechaFormateada = dia + '-' + mes + '-' + año;
    document.getElementById('fecha_vencimiento').innerText = fechaFormateada;
});