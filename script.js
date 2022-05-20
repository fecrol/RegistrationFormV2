function validateString(element, valIcon) {
    /*
    Sends a POST request to validate the forename field input and update the validation icon accordingly.
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
    
    forenameEl.onkeyup = () => {
        validateString(forenameEl, forenameValIcon);
    }

    surnameEl.onkeyup = () => {
        
    }
})
