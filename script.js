function validateString(element, valIcon) {
    /*
    Sends a POST request to validate a text input field which is to contain letters only and update the validation icon accordingly.
    */

    data = {string: element.value};
    url = "http://localhost/_registrationForm/form-validation/validateString.php";

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {
        
        response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function validateEmail(emailEl, valIcon) {
    /*
    Sends a POST request to validate a email input field which is to contain a valid email and update the validation icon accordingly.
    */

    data = {email: emailEl.value};
    url = "http://localhost/_registrationForm/form-validation/validateEmail.php";

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {

        response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function validatePasswordsMatch(passEl, confirmPassEl, valIcon) {
    /*
    Sends a POST request to validate if the password and confirm password fields match to update the validation icon accordingly.
    */

    data = {pass: passEl.value, confirmPass: confirmPassEl.value};
    url = "http://localhost/_registrationForm/form-validation/validatePasswordsMatch.php";

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {

        response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function updateValidationIcon(validationRes, element) {
    /*
    Updates the validation icon based on validation response.
    */

    if(validationRes) {
        element.classList.remove("fa-xmark");
        element.classList.add("fa-check");
        element.style.color = "#00FF00";
    }
    else {
        element.classList.remove("fa-check");
        element.classList.add("fa-xmark");
        element.style.color = "#ee3344";
    }
}

document.addEventListener("DOMContentLoaded", () => {

    forenameEl = document.getElementById("forename");
    forenameValIcon = document.getElementById("forename-str");

    surnameEl = document.getElementById("surname");
    surnameValIcon = document.getElementById("surname-str");

    emailEl = document.getElementById("email");
    emailValIcon = document.getElementById("valid-email");

    passEl = document.getElementById("pass1");

    confirmPassEl = document.getElementById("pass2");
    confirmPassValIcon = document.getElementById("pass-match");

    forenameEl.onkeyup = () => {
        validateString(forenameEl, forenameValIcon);
    }

    surnameEl.onkeyup = () => {
        validateString(surnameEl, surnameValIcon);    
    }

    emailEl.onkeyup = () => {
        validateEmail(emailEl, emailValIcon);
    }

    passEl.onkeyup = () => {
        validatePasswordsMatch(passEl, confirmPassEl, confirmPassValIcon);
    }
    
    confirmPassEl.onkeyup = () => {
        validatePasswordsMatch(passEl, confirmPassEl, confirmPassValIcon);
    }
})
