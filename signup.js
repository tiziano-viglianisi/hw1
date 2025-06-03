function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.surname] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function onjsonCheckUsername(json) {
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
    }
}

function onjsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        input.parentNode.classList.add('errorj');
        formStatus.username = false;

    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(onjsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;

    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(onjsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    const value = passwordInput.value;
    const hasMinLength = value.length >= 8;
    const hasUppercase = /[A-Z]/.test(value);
    const hasSpecialChar = /[^A-Za-z0-9]/.test(value);

    if (formStatus.password = hasMinLength && hasUppercase && hasSpecialChar) {
        document.querySelector('.password').classList.remove('errorj');
        document.querySelector('.password span').textContent = "";
    } else {
        document.querySelector('.password').classList.add('errorj');
        document.querySelector('.password span').textContent = "La password deve contenere almeno 8 caratteri, una maiuscola e un carattere speciale.";
    }
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confirm_password input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
    } else {
        document.querySelector('.confirm_password').classList.add('errorj');
    }
}

function checkProfilePic(event) {
    const profilePicInput = document.querySelector('.profile_pic input');
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    if (profilePicInput.files.length > 0) {
        const file = profilePicInput.files[0];
        if (!allowedTypes.includes(file.type)) {
            document.querySelector('.profile_pic span').textContent = "Formato non supportato. Solo PNG, JPG, JPEG, GIF, WEBP.";
            document.querySelector('.profile_pic').classList.add('errorj');
            formStatus.upload = false;
        } else if (file.size > 16000000) { // 16MB
            document.querySelector('.profile_pic span').textContent = "File troppo grande";
            document.querySelector('.profile_pic').classList.add('errorj');
            formStatus.upload = false;
        } else {
            document.querySelector('.profile_pic').classList.remove('errorj');
            document.querySelector('.profile_pic span').textContent = "";
            formStatus.upload = true;
        }
    } else {
        document.querySelector('.profile_pic span').textContent = "Nessun file selezionato";
        document.querySelector('.profile_pic').classList.add('errorj');
        formStatus.upload = false;
    }
}


function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    const gender = document.querySelector('.gender input:checked');
    const type = document.querySelector('.type input:checked');
    formStatus[checkbox.name] = checkbox.checked;
    console.log(formStatus);
    console.log(Object.keys(formStatus).length);
    if (Object.keys(formStatus).length !== 8 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
        console.log("fallito")
    }
}

const formStatus = {'upload': true};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.profile_pic input').addEventListener('change', checkProfilePic);
document.querySelector('form').addEventListener('submit', checkSignup);