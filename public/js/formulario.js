document.addEventListener("DOMContentLoaded", function () {
    document.body.style.display = "block";
});

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("pass");
    var eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = abiertoSvgUrl;
    } else {
        passwordInput.type = "password";
        eyeIcon.src = cerradoSvgUrl;
    }
}
