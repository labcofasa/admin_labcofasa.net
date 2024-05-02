document.addEventListener("DOMContentLoaded", function () {
    var fechaActual = new Date();
    var fechaVencimientoElemento = document.getElementById("fecha_vencimiento");

    if (fechaVencimientoElemento) {
        var fechaVencimientoTexto = fechaVencimientoElemento.innerText;
        if (fechaVencimientoTexto.trim() !== "") {
            var partesFecha = fechaVencimientoTexto.split("-");
            var dia = parseInt(partesFecha[0]);
            var mes = parseInt(partesFecha[1]) - 1;
            var anio = parseInt(partesFecha[2]);

            var fechaVencimiento = new Date(anio, mes, dia);
            if (fechaVencimiento <= fechaActual) {
                fechaVencimientoElemento.classList.add("fecha-vencida");
            }
        }
    }
});