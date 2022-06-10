const BASE_URL = "http://localhost/"

function validateString(element, valIcon) {
    /*
    Sends a POST request to validate a text input field which is to contain letters only and update the validation icon accordingly.
    */

    let data = {string: element.value};
    let requestURL = "_registrationForm/form-validation/validateString.php"
    let url = BASE_URL + requestURL;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {
        
        let response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function validateEmail(emailEl, valIcon) {
    /*
    Sends a POST request to validate a email input field which is to contain a valid email and update the validation icon accordingly.
    */

    let data = {email: emailEl.value};
    let requestURL = "_registrationForm/form-validation/validateEmail.php";
    let url = BASE_URL + requestURL;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {

        let response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function validatePassword(passwordEl, valIcons) {
    /*
    Sends a POST request to validate if the password field contains a valid password and updates the validation icon accordingly.
    */

    let data = {password: passwordEl.value};
    let requestURL = "_registrationForm/form-validation/validatePassword.php";
    let url = BASE_URL + requestURL;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {

        for(let i=0; i<Object.keys(data["msg"]).length; i++) {
            
            let response = data["msg"][Object.keys(data["msg"])[i]];
            let valIcon = valIcons[i];
            
            updateValidationIcon(response, valIcon);
        }
    })
}

function validatePasswordsMatch(passEl, confirmPassEl, valIcon) {
    /*
    Sends a POST request to validate if the password and confirm password fields match to update the validation icon accordingly.
    */

    let data = {pass: passEl.value, confirmPass: confirmPassEl.value};
    let requestURL = "_registrationForm/form-validation/validatePasswordsMatch.php";
    let url = BASE_URL + requestURL;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {

        let response = data["msg"];
        updateValidationIcon(response, valIcon);
    })
}

function signup(userData, inputEls, valIcons) {
    /*
    POST request to handle user signup.
    */

    let data = userData;
    let requestURL = "_registrationForm/user/create.php";
    let url = BASE_URL + requestURL;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then(res => res.json()).then(data => {
        
        let response = data["msg"];

        if(response === "success") {
            hideEmailError();
            displaySuccessMsg();
            resetForm(inputEls, valIcons);
        }

        if(response === "exists") {
            hideSuccessMsg();
            displayEmailError();
        }
        
        if(response === "fail") {
            hideEmailError();
            hideSuccessMsg();
            flashXicons(valIcons);
        }
        
        if(response === "empty") {
            hideEmailError();
            hideSuccessMsg();
            flashXicons(valIcons);
        }
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

function flashXicons(icons) {
    /*
    Adds a flash effect to x icons to notify user form is invalid.
    */

    let iconClass = "fa-xmark";
    let flashClass = "flash";
    
    for(let i=0; i<icons.length; i++) {

        if(icons[i].classList.contains(iconClass)) {
            icons[i].classList.add(flashClass);
        }
    }
}

function removeIconFlash(icons) {
    /*
    Removes the flash class from icons to stop icons from flashing.
    */
    
    let flashClass = "flash";

    for(let i=0; i<icons.length; i++) {

        if(icons[i].classList.contains(flashClass)) {
            icons[i].classList.remove(flashClass);
        }
    }
}

function resetForm(inputEls, valIcons) {
    /*
    Resets the signup form when called.
    */

    const response = false;
    
    for(let i=0; i<inputEls.length; i++) {
        inputEls[i].value = "";
    }

    for(let i=0; i<valIcons.length; i++) {
        updateValidationIcon(response, valIcons[i]);
    }
}

function displaySuccessMsg() {

    const msgDiv = document.getElementById("success-msg");
    msgDiv.style.display = "block";
}

function hideSuccessMsg() {

    const msgDiv = document.getElementById("success-msg");
    msgDiv.style.display = "none";
}

function displayEmailError() {
    
    const msgDiv = document.getElementById("email-exists");
    msgDiv.style.display = "block";
}

function hideEmailError() {

    const msgDiv = document.getElementById("email-exists");
    msgDiv.style.display = "none";
}

document.addEventListener("DOMContentLoaded", () => {

    let forenameEl = document.getElementById("forename");
    let forenameValIcon = document.getElementById("forename-str");

    let surnameEl = document.getElementById("surname");
    let surnameValIcon = document.getElementById("surname-str");

    let emailEl = document.getElementById("email");
    let emailValIcon = document.getElementById("valid-email");

    let passEl = document.getElementById("pass1");
    let lengthValIcon = document.getElementById("pass-length");
    let upperValIcon = document.getElementById("char-upper");
    let numValIcon = document.getElementById("char-num");
    let approvedSpecialValIcon = document.getElementById("char-special");
    let illegalSpecialValIcon = document.getElementById("char-special-illegal");
    
    let passValIcons = [
        lengthValIcon,
        upperValIcon,
        numValIcon,
        approvedSpecialValIcon,
        illegalSpecialValIcon
    ];

    let confirmPassEl = document.getElementById("pass2");
    let confirmPassValIcon = document.getElementById("pass-match");

    let formEl = document.getElementById("signup-form");
    let submitBtn = document.getElementById("submit");

    let inputElements = [
        forenameEl,
        surnameEl,
        emailEl,
        passEl,
        confirmPassEl
    ]
    
    let icons = [
        forenameValIcon,
        surnameValIcon,
        emailValIcon,
        lengthValIcon,
        upperValIcon,
        numValIcon,
        approvedSpecialValIcon,
        illegalSpecialValIcon,
        confirmPassValIcon
    ]
    
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
        validatePassword(passEl, passValIcons);
        validatePasswordsMatch(passEl, confirmPassEl, confirmPassValIcon);
    }
    
    confirmPassEl.onkeyup = () => {
        validatePasswordsMatch(passEl, confirmPassEl, confirmPassValIcon);
    }

    formEl.addEventListener("submit", (event) => {

        event.preventDefault();

        let userData = {
            forename: forenameEl.value,
            surname: surnameEl.value,
            email: emailEl.value,
            password: passEl.value,
            confirmPass: confirmPassEl.value
        }

        removeIconFlash(icons);
        signup(userData, inputElements, icons);
        submitBtn.blur();
    })
})
