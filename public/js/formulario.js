document.addEventListener("DOMContentLoaded", function () {
    document.body.style.display = "block";
});

function verClave() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = abiertoSvgUrl;
    } else {
        passwordInput.type = "password";
        eyeIcon.src = cerradoSvgUrl;
    }
}

function verClaveRest() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = abiertoSvgUrl;
    } else {
        passwordInput.type = "password";
        eyeIcon.src = cerradoSvgUrl;
    }
}

function verClaveRestConfirm() {
    var passwordInput = document.getElementById("password_confirmation");
    var eyeIcon = document.getElementById("eye-icon-confirm");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = abiertoSvgUrl;
    } else {
        passwordInput.type = "password";
        eyeIcon.src = cerradoSvgUrl;
    }
}
