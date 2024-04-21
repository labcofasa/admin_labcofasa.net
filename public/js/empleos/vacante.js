document.addEventListener("DOMContentLoaded", function () {
    var fechaActual = new Date();
    var fechaVencimientoElemento = document.getElementById("fecha_vencimiento");

    if (fechaVencimientoElemento) {
        var fechaVencimientoTexto = fechaVencimientoElemento.innerText;
        if (fechaVencimientoTexto.trim() !== "") {
            var fechaVencimiento = new Date(fechaVencimientoTexto);
            if (fechaVencimiento <= fechaActual) {
                fechaVencimientoElemento.classList.add("fecha-vencida");
            }
        }
    }
});
