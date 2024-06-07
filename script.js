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

// Admin functions

function categoryRegister() {

    let category = document.getElementById("category");

    let f = new FormData();

    f.append("c", category.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: "Successfully Added" + " " + category.value,
                    icon: "success",
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "error",
                });
            }

        }
    }

    r.open("POST", "categoryRegProcess.php", true);
    r.send(f);

}

function brandRegister() {

    let brand = document.getElementById("brand");

    let f = new FormData();

    f.append("b", brand.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: "Successfully Added" + " " + brand.value,
                    icon: "success",
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "error",
                });
            }

        }
    }

    r.open("POST", "brandRegProcess.php", true);
    r.send(f);

}

function modelRegister() {

    let model = document.getElementById("model");

    let f = new FormData();

    f.append("m", model.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: "Successfully Added" + " " + model.value,
                    icon: "success",
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "error",
                });
            }

        }
    }

    r.open("POST", "modelRegProcess.php", true);
    r.send(f);

}

function colorRegister() {

    let color = document.getElementById("color");

    let f = new FormData();

    f.append("col", color.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: "Successfully Added" + " " + color.value,
                    icon: "success",
                });
            } else {
                Swal.fire({
                    title: response,
                    icon: "error",
                });
            }

        }
    }

    r.open("POST", "colorRegProcess.php", true);
    r.send(f);

}

// Admin functions

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

function deleteCart(id) {

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "removed") {

                Swal.fire({
                    title: "Product is removed from Cart!",
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
                });

            }

        }
    }

    r.open("GET", "deleteCartProcess.php?id=" + id, true);
    r.send();

}

function changeQty(id) {

    let qty = document.getElementById("qty").value;

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;
            if (response == "updated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    r.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
    r.send();

}

// cart

// Buy now

function buyNow(id) {

    let qty = document.getElementById("qty").value;

    let r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            var obj = JSON.parse(response);

            let mail = obj["umail"];
            let amount = obj["amount"];

            if (response == 1) {

                Swal.fire({
                    title: "Please Login!",
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "login.php";
                    }
                });

            } else if (response == 2) {

                Swal.fire({
                    title: "Please update your profile!",
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "profile.php";
                    }
                });

            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    Swal.fire({
                        title: "Payment completed. OrderID:" + orderId,
                        icon: "success",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            saveInvoice(orderId, id, mail, amount, qty);
                        }
                    });

                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/pbaysl/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/pbaysl/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    r.open("GET", "paymentProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    let f = new FormData();
    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
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
        }
    }

    r.open("POST", "saveInvoiceProcess.php", true);
    r.send(f);

}

// Buy now

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

// Profile update

function changeProfileimage() {

    let img = document.getElementById("profileimage");

    img.onchange = function () {
        let file = this.files[0];
        let url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }

}

function updateProfile() {

    let fname = document.getElementById("fname");
    let lname = document.getElementById("lname");
    let line1 = document.getElementById("line1");
    let line2 = document.getElementById("line2");
    let pcode = document.getElementById("pcode");
    let city = document.getElementById("city");
    let district = document.getElementById("district");
    let province = document.getElementById("province");
    let image = document.getElementById("profileimage");

    let f = new FormData();

    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("pc", pcode.value);
    f.append("c", city.value);
    f.append("d", district.value);
    f.append("p", province.value);
    f.append("i", image.files[0]);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "updated" || response == "saved") {

                Swal.fire({
                    title: "Done!",
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            } else if (response == "You have not selected any image!") {

                Swal.fire({
                    title: "You have not selected any image!",
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
                })

            }

        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

// Profile update

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

    r.open("POST", "userStatusProcess.php", true);
    r.send(f);

}

// Product registration

function registerProduct() {

    let category = document.getElementById("category");
    let brand = document.getElementById("brand");
    let model = document.getElementById("model");
    let color = document.getElementById("color");
    let title = document.getElementById("product_title");
    let condition = document.getElementById("condition");
    let price = document.getElementById("price");
    let qty = document.getElementById("qty");
    let dwc = document.getElementById("dwc");
    let doc = document.getElementById("doc");
    let description = document.getElementById("desc");
    let product_image = document.getElementById("imageuploader");


    let f = new FormData();

    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("col", color.value);
    f.append("t", title.value);
    f.append("con", condition.value);
    f.append("p", price.value);
    f.append("q", qty.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", description.value);

    let file_count = product_image.files.length;

    for (let x = 0; x < file_count; x++) {
        f.append("image" + x, product_image.files[x]);
    }

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {
                Swal.fire({
                    title: title.value + " has been Successfully Registered!",
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
                });
            }
        }
    }

    r.open("POST", "productRegProcess.php", true);
    r.send(f);

}

// Image uploading

function addProductImage() {

    let image = document.getElementById("imageuploader");

    image.onchange = function () {
        let file_count = image.files.length;

        if (file_count <= 1) {

            for (let x = 0; x < file_count; x++) {

                let file = this.files[x];
                let url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {

            alert(file_count + " files. You are proceed to upload only one image.");

        }
    }

}

function updateStock() {

    let select_product = document.getElementById("sp");
    let qty = document.getElementById("q");
    let unit_price = document.getElementById("up");

    let f = new FormData();

    f.append("sp", select_product.value);
    f.append("q", qty.value);
    f.append("up", unit_price.value);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;

            if (response == "success") {

                Swal.fire({
                    title: "Product Successfully Updated!",
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
                });
            }

        }
    }

    r.open("POST", "updateStockProcess.php", true);
    r.send(f);

}

// Product registration

// Admin Panel

// User

function advancedSearch(x) {

    let txt = document.getElementById("t");
    let category = document.getElementById("c1");
    let brand = document.getElementById("b1");
    let model = document.getElementById("m");
    let condition = document.getElementById("c2");
    let color = document.getElementById("c3");
    let price_from = document.getElementById("pf");
    let price_to = document.getElementById("pt");

    let f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", price_from.value);
    f.append("pt", price_to.value);
    f.append("page", x);

    let r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            let response = r.responseText;
            document.getElementById("view_area").innerHTML = response;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

// User