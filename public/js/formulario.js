document.addEventListener("DOMContentLoaded", function () {
    document.body.style.display = "block";
});

function verClave() {
    if (passwordIcon.innerText === "visibility") {
        passwordIcon.innerText = "visibility_off";
        password.type = "text";
    } else {
        passwordIcon.innerText = "visibility";
        password.type = "password";
    }
}

function verClaveRest() {
    if (passwordIconRest.innerText === "visibility") {
        passwordIconRest.innerText = "visibility_off";
        password.type = "text";
    } else {
        passwordIconRest.innerText = "visibility";
        password.type = "password";
    }
}

function verClaveRestConfirm() {
    if (passwordIconRestConfirm.innerText === "visibility") {
        passwordIconRestConfirm.innerText = "visibility_off";
        password_confirmation.type = "text";
    } else {
        passwordIconRestConfirm.innerText = "visibility";
        password_confirmation.type = "password";
    }
}
