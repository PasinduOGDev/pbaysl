// Mode Changer Start

function setMode() {

    var mode = document.getElementById("mode");
    var loginbox = document.getElementById("loginbox");
    var registerbox = document.getElementById("registerbox");
    var forgotpassword = document.getElementById("forgotPassword");
    var register = document.getElementById("register");
    var change = document.getElementById("change");
    var change2 = document.getElementById("change2");


    var element = document.body;
    element.dataset.bsTheme = element.dataset.bsTheme == "light" ? "dark" : "light";

    if (element.dataset.bsTheme == "dark") {
        mode.innerHTML = '<i class="bi bi-moon"></i>';
        element.classList.remove("bg-secondary");
        element.classList.add("bg-dark");
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
        element.classList.remove("bg-dark");
        element.classList.add("bg-secondary");
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

function changeView() {

    var loginbox = document.getElementById("loginbox");
    var registerbox = document.getElementById("registerbox");

    loginbox.classList.toggle("d-none");
    registerbox.classList.toggle("d-none");

}

// Login function

function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();

    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberme.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "Success") {

                Swal.fire({
                    title: "Success!",
                    text: "Log in Successfully!",
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

        request.open("POST", "loginProcess.php", true);
        request.send(form)

    }

}

// Login function

// Register function

function register() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email2");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("password2");
    var cpassword = document.getElementById("cpassword");
    var agreebox = document.getElementById("agreeBox");

    var f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("p", password.value);
    f.append("cp", cpassword.value);
    f.append("a", agreebox.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;

            if (response == "Success") {

                Swal.fire({
                    title: "Success!",
                    text: "Registration Successfully!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        changeView();
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

    r.open("POST", "registerProcess.php", true);
    r.send(f);

}

// Register function