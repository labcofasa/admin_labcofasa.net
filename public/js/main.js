document.addEventListener("DOMContentLoaded", function () {
    const body = document.querySelector("body");
    const darkIcon = document.querySelector(".dropdown-icon.dark");
    const lightIcon = document.querySelector(".dropdown-icon.light");
    const toggleSwitchNav2 = document.getElementById("toggle-switch-nav2");
    const arrows = document.querySelectorAll(".arrow");
    const modeTextToggle = toggleSwitchNav2.querySelector(".mode-text");
    const storedMode = localStorage.getItem("mode");

    function toggleMode() {
        const isDarkMode = !body.classList.contains("dark");
        body.classList.toggle("dark", isDarkMode);

        darkIcon.style.display = isDarkMode ? "block" : "none";
        lightIcon.style.display = isDarkMode ? "none" : "block";

        localStorage.setItem("mode", isDarkMode ? "dark" : "light");
    }

    toggleSwitchNav2.addEventListener("click", toggleMode);

    body.classList.toggle("dark", storedMode === "dark");

    darkIcon.style.display = storedMode === "dark" ? "block" : "none";
    lightIcon.style.display = storedMode === "dark" ? "none" : "block";

    body.style.display = "block";

    arrows.forEach(arrow => {
        arrow.addEventListener("click", (e) => {
            const liParent = e.target.closest('li');

            if (liParent) {
                liParent.classList.toggle("showMenu");
            }
        });
    });

    habilitarTooltips();
});

function habilitarTooltips() {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = Array.from(tooltipTriggerList).map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

function mostrarToast(mensaje, tipo) {
    const toast = document.getElementById("notificacion");

    toast.querySelector(".toast-body").textContent = mensaje;

    toast.classList.remove("toast-success", "toast-error", "bg-danger");

    if (tipo === "success") {
        toast.classList.add("toast-success");
    } else if (tipo === "error") {
        toast.classList.add("toast-error", "bg-danger");
    }

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}
