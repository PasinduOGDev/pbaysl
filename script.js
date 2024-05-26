// redirect

function redirect() {
    window.location = "index.php";
}

// Mode Changer Start

function setMode() {

    var mode = document.getElementById("mode");
    var loginbox = document.getElementById("loginbox");
    var registerbox = document.getElementById("registerbox");
    var forgotpassword = document.getElementById("forgotPassword");
    var register = document.getElementById("register");
    var change = document.getElementById("change");
    var change2 = document.getElementById("change2");


    var body = document.body;
    body.dataset.bsTheme = body.dataset.bsTheme == "light" ? "dark" : "light";

    if (body.dataset.bsTheme == "dark") {
        mode.innerHTML = '<i class="bi bi-moon"></i>';
        body.classList.remove("bg-secondary");
        body.classList.add("bg-dark");
        loginbox.classList.add("bg-secondary");
        registerbox.classList.add("bg-secondary");
        forgotpassword.classList.add("link-light");
        register.classList.remove("btn-success");
        register.classList.add("btn-primary");
        change.classList.remove("btn-danger");
        change.classList.add("btn-warning");

        change2.classList.remove("btn-success");
        change2.classList.add("btn-warning");
    } else {
        mode.innerHTML = '<i class="bi bi-brightness-high text-white"></i>';
        body.classList.remove("bg-dark");
        body.classList.add("bg-secondary");
        loginbox.classList.remove("bg-secondary");
        registerbox.classList.remove("bg-secondary");
        forgotpassword.classList.remove("link-light");
        register.classList.remove("btn-primary");
        register.classList.add("btn-success");
        change.classList.remove("btn-warning");
        change.classList.add("btn-danger");

        change2.classList.remove("btn-warning");
        change2.classList.add("btn-success");
    }

}

// Mode Changer End

// Theme Changer Start

function themeChange() {

    var icon = document.getElementById("icon");

    var body = document.body;
    body.dataset.bsTheme = body.dataset.bsTheme == "light" ? "dark" : "light";

    if (body.dataset.bsTheme == "dark") {
        icon.innerHTML = '<i class="bi bi-moon text-white"></i>';
        body.classList.add("bg-dark");
    } else {
        icon.innerHTML = '<i class="bi bi-brightness-high text-dark"></i>';
        body.classList.remove("bg-dark");
    }

}

// Theme Changer End

function changeView() {

    var loginbox = document.getElementById("loginbox");
    var registerbox = document.getElementById("registerbox");

    loginbox.classList.toggle("d-none");
    registerbox.classList.toggle("d-none");

}

// Register function

function register() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email2");
    var mobile = document.getElementById("mobile");
    var agreebox = document.getElementById("agreeBox");

    var f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("a", agreebox.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;

            if (response == "Success") {

                Swal.fire({
                    title: "Registration Successfully!",
                    text: "Please check your Email before Login!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        changeView();
                    }
                });

            } else {

                Swal.fire({
                    title: "Failed!",
                    text: response,
                    icon: "error",
                });

            }
        }

    }

    r.open("POST", "registerProcess.php", true);
    r.send(f);

}

// Register function

// Login function

function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();

    form.append("e", email.value);
    form.append("p", password.value);
    form.append("rm", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "Success") {

                Swal.fire({
                    title: "Logged in!",
                    text: "Log in Success!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "index.php";
                    }
                });

            } else {

                Swal.fire({
                    title: "Error!",
                    text: response,
                    icon: "error",
                });

            }

        }
    }

    request.open("POST", "loginProcess.php", true);
    request.send(form);

}

// Forgot password
var otpModal;
function forgotPassword() {

    var otpbox = document.getElementById("otpBox");

    otpModal = new bootstrap.Modal(otpbox);
    otpModal.show();

}

function sendCode() {

    var email = document.getElementById("email3");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            
            if (response == "Success") {

                Swal.fire({
                    title: "Sent!",
                    text: "OTP Sent Successfully! Please check your inbox",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetPasswordBox();
                    }
                });

            } else {

                Swal.fire({
                    title: "Failed!",
                    text: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        forgotPassword();
                    }
                });

            }

            if (response == "Please enter your Email in the Email field") {
                
                Swal.fire({
                    title: "Error!",
                    text: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        forgotPassword();
                    }
                });

            }
            
        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

var resetPwModal;

function resetPasswordBox() {

    var modal = document.getElementById("resetPwBox");
    resetPwModal = new bootstrap.Modal(modal);
    resetPwModal.show();

}

function resetPassword() {

    var email = document.getElementById("email3");
    var otp = document.getElementById("otp");
    var new_password = document.getElementById("password2");
    var confirm_password = document.getElementById("password2");

    var f = new FormData();

    f.append("e",email.value);
    f.append("o",otp.value);
    f.append("np",new_password.value);
    f.append("cp",confirm_password.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            
            if (response == "Success") {
                
                Swal.fire({
                    title: "Done!",
                    text: "Your Password has been Successfully reset!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });


            } else {
                
                Swal.fire({
                    title: "Failed!",
                    text: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetPasswordBox();
                    }
                });

            }

        }
    }

    r.open("POST","resetPasswordProcess.php", true);
    r.send(f);

}

// Forgot password

// View password

function viewPassword() {

    var textfield = document.getElementById("password");
    var button = document.getElementById("pwBtn");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        textfield.type = "password";
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }

}

// View password

// View password - For forgot password modal

function viewPassword2() {

    var textfield = document.getElementById("password2");
    var button = document.getElementById("pwBtn2");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        textfield.type = "password";
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }

}

// View password

function viewPassword3() {

    var textfield = document.getElementById("password3");
    var button = document.getElementById("pwBtn3");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        textfield.type = "password";
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }

}

// View password

// View password - For forgot password modal

// Login function

// signout start

function signOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            }
        }
    };

    r.open("GET", "logoutProcess.php", true);
    r.send();

}

// signout end

// cart

function addtoCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;

            if (response == "added") {

                Swal.fire({
                    title: "Done!",
                    text: "Product is added to Cart",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            } if (response == "updated") {

                Swal.fire({
                    title: "Done!",
                    text: "Product is updated",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            }

            if (response == "invalid") {

                Swal.fire({
                    title: "Error!",
                    text: "Invalid Amount",
                    icon: "error",
                });

            }

            if (response == "Someting went wrong!") {

                Swal.fire({
                    title: "Error!",
                    text: "Someting went wrong! Please try again",
                    icon: "error",
                });

            }

            if (response == "Please Login First") {

                Swal.fire({
                    title: "Attention!",
                    text: "Please Login First!",
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "login.php";
                    }
                });

            }

        }
    }

    r.open("GET", "cartProcess.php?id=" + id, true);
    r.send();

}

// cart

// User profile update

// View password

function viewPassword4() {

    var textfield = document.getElementById("password");
    var button = document.getElementById("pwBtn");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        textfield.type = "password";
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }

}

// View password

// User profile update