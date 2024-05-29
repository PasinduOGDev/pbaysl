// redirect

function redirect() {
    window.location = "index.php";
}

// Mode Changer Start

function setMode() {

    let mode = document.getElementById("mode");
    let loginbox = document.getElementById("loginbox");
    let registerbox = document.getElementById("registerbox");
    let adminbox = document.getElementById("adminbox");
    let forgotpassword = document.getElementById("forgotPassword");
    let register = document.getElementById("register");
    let change = document.getElementById("change");
    let change2 = document.getElementById("change2");


    let body = document.body;
    body.dataset.bsTheme = body.dataset.bsTheme == "light" ? "dark" : "light";

    if (body.dataset.bsTheme == "dark") {
        mode.innerHTML = '<i class="bi bi-moon"></i>';
        body.classList.remove("bg-secondary");
        body.classList.add("bg-dark");
        loginbox.classList.add("bg-secondary");
        registerbox.classList.add("bg-secondary");
        adminbox.classList.add("bg-secondary");
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
        adminbox.classList.remove("bg-secondary");
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

    let icon = document.getElementById("icon");

    let body = document.body;
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

    let loginbox = document.getElementById("loginbox");
    let registerbox = document.getElementById("registerbox");

    loginbox.classList.toggle("d-none");
    registerbox.classList.toggle("d-none");

}

// Register function

function register() {

    let fname = document.getElementById("fname");
    let lname = document.getElementById("lname");
    let email = document.getElementById("email2");
    let mobile = document.getElementById("mobile");
    let agreebox = document.getElementById("agreeBox");

    let f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("a", agreebox.checked);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

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

    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let rememberme = document.getElementById("rememberme");

    let form = new FormData();

    form.append("e", email.value);
    form.append("p", password.value);
    form.append("rm", rememberme.checked);

    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let response = request.responseText;

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

            if (response == "Your Membership is Temporary Banned!") {

                Swal.fire({
                    title: "You're Banned!",
                    text: response,
                    icon: "warning",
                });

            }

        }
    }

    request.open("POST", "loginProcess.php", true);
    request.send(form);

}

var otpModal;
function forgotPassword() {

    let otpbox = document.getElementById("otpBox");

    otpModal = new bootstrap.Modal(otpbox);
    otpModal.show();

}

function sendCode() {

    let email = document.getElementById("email3");

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

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

    let modal = document.getElementById("resetPwBox");
    resetPwModal = new bootstrap.Modal(modal);
    resetPwModal.show();

}

function resetPassword() {

    let email = document.getElementById("email3");
    let otp = document.getElementById("otp");
    let new_password = document.getElementById("password2");
    let confirm_password = document.getElementById("password2");

    let f = new FormData();

    f.append("e", email.value);
    f.append("o", otp.value);
    f.append("np", new_password.value);
    f.append("cp", confirm_password.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

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

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

// Forgot password

// View password

function viewPassword() {

    let textfield = document.getElementById("password");
    let button = document.getElementById("pwBtn");

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

    let textfield = document.getElementById("password2");
    let button = document.getElementById("pwBtn2");

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

    let textfield = document.getElementById("password3");
    let button = document.getElementById("pwBtn3");

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

// admin login
function adminlogin() {

    let email = document.getElementById("email");
    let password = document.getElementById("password");

    let f = new FormData();

    f.append("e", email.value);
    f.append("p", password.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "Success") {

                Swal.fire({
                    title: "Done!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "admin-dashboard.php";
                    }
                });

            } else {
                Swal.fire({
                    title: response,
                    icon: "error",
                })
            }

        }
    }

    r.open("POST", "admin-loginProcess.php", true);
    r.send(f);

}
// admin login

// Login function

// signout start

// admin

function adminLogout() {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: "Logged Out!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.php";
                    }
                });
            } else {
                Swal.fire({
                    title: "Log Out Failed!",
                    icon: "error",
                });
            }

        }
    }

    r.open("GET", "admin-logoutProcess.php", true);
    r.send();

}

// admin

// user

function signOut() {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            let t = r.responseText;
            if (t == "success") {

                Swal.fire({
                    title: "Logged Out!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            } else {

                Swal.fire({
                    title: "Log Out Failed!",
                    icon: "error",
                });

            }

        }

    };

    r.open("GET", "logoutProcess.php", true);
    r.send();

}

// user

// signout end

// cart

function addtoCart(id) {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

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

    let textfield = document.getElementById("password");
    let button = document.getElementById("pwBtn");

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

// Admin Panel

function loadUser() {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    }

    r.open("POST", "loaduserProcess.php", true);
    r.send();

}

function updateUserStatus() {

    let user_email = document.getElementById("u_email");

    let f = new FormData();

    f.append("u", user_email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            
            if (response == "Deactivated") {
                
                Swal.fire({
                    title: "Deactivated!",
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                
            } else {

                Swal.fire({
                    title: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                }); 

            }
            
            if (response == "Activated") {

                Swal.fire({
                    title: "Activated!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                
            } else {

                Swal.fire({
                    title: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            }

            if (response == "Please enter User Email") {

                Swal.fire({
                    title: response,
                    icon: "error",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
                
            }
        }

    }

    r.open("POST","userStatusProcess.php",true);
    r.send(f);

}

// Admin Panel