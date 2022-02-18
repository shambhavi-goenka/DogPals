
/// animation for signin/signup
document.addEventListener('DOMContentLoaded', () => {
	

    anime({
		targets: '.box',
		translateX: [-400, 0],
		easing: 'easeOutExpo'
	})


})




// check if username exists in the database
function checkUsername() {
    jQuery.ajax({
        url: 'check_avail.php',
        data: 'username='+$("#username2").val(),
        type: "POST",
        success: function(data){
            $("#check-username").html(data)
        },
        error:function() {}
    })
}


const main = document.getElementsByTagName("main")[0]
const toggle_button = document.getElementsByClassName("toggle")
const sign_up_link = document.getElementById("sign-up-link")
const sign_in_link = document.getElementById("sign-in-link")



for(btn of toggle_button){
    btn.addEventListener("click", function(){
        main.classList.toggle("sign-up-mode")
    })
}




// form validation - sign in form
const usernameEl = document.getElementById('username1');
const passwordEl = document.getElementById('password1');
const form1 = document.getElementById('form1');

//form validation - sign up form
const usernameEl_2 = document.getElementById('username2');
const emailEl_2 = document.getElementById('email2');
const passwordEl_2 = document.getElementById('password2');
const confirmPasswordEl_2 = document.getElementById('confirmpassword2');
const form2 = document.getElementById('form2')

// remove exisiting fields if user clicks to go to sign up page
sign_up_link.addEventListener("click", function() {
    usernameEl.value = ''
    passwordEl.value = ''
    if(document.getElementById("error-alert")) {
        document.getElementById("error-alert").style.display = 'none'
    }
    if(usernameEl.parentNode.className.includes('error')) {
        usernameEl.parentNode.classList.remove('error')
    }
    else if(usernameEl.parentNode.className.includes('success')){
        usernameEl.parentNode.classList.remove('success')
    }

    if(passwordEl.parentNode.className.includes('error')) {
        passwordEl.parentNode.classList.remove('error')
    }
    else if(passwordEl.parentNode.className.includes('success')){
        passwordEl.parentNode.classList.remove('success')
    }
})


// remove exisiting fields if user clicks to go to sign in page
sign_in_link.addEventListener("click", function() {
    usernameEl_2.value = ''
    emailEl_2.value = ''
    passwordEl_2.value = ''
    confirmPasswordEl_2.value = ''

    
    if(document.getElementById("recaptcha_error")) {
        document.getElementById("recaptcha_error").style.display = 'none'
    }
    

    if(usernameEl_2.parentNode.className.includes('error')) {
        usernameEl_2.parentNode.classList.remove('error')
    }
    else if(usernameEl_2.parentNode.className.includes('success')){
        usernameEl_2.parentNode.classList.remove('success')
    }

    if(emailEl_2.parentNode.className.includes('error')) {
        emailEl_2.parentNode.classList.remove('error')
    }
    else if(emailEl_2.parentNode.className.includes('success')){
        emailEl_2.parentNode.classList.remove('success')
    }

    if(passwordEl_2.parentNode.className.includes('error')) {
        passwordEl_2.parentNode.classList.remove('error')
    }
    else if(passwordEl_2.parentNode.className.includes('success')){
        passwordEl_2.parentNode.classList.remove('success')
    }

    if(confirmPasswordEl_2.parentNode.className.includes('error')) {
        confirmPasswordEl_2.parentNode.classList.remove('error')
    }
    else if(confirmPasswordEl_2.parentNode.className.includes('success')){
        confirmPasswordEl_2.parentNode.classList.remove('success')
    }
})

// show error border for failed login
if(document.getElementById("error-alert")) {
    showError(usernameEl,"")
    showError(passwordEl,"")
}



// common functions
function isRequired(value) {
    return ( value === '' ? false : true)
}

function validateEmail(email){
    const re =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return re.test(email)
}

function isPasswordSecure(password) {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})")
    return re.test(password)
}



function showError(input, message){
    const formField = input.parentElement
    formField.classList.remove("success")
    formField.classList.add("error")
    
    const error = formField.getElementsByTagName("small")[0]
    //show error message
    // const error = formField.querySelector("small")
    error.innerHTML = message
}

function showSuccess(input){
    const formField = input.parentElement
    formField.classList.remove("error")
    formField.classList.add("success")

    const error = formField.querySelector("small")
    error.textContent = ""
}


// sign in 
// decided whether you want to keep or remove green border - once red border is shown, cant be remvoved 
function checkUsername1() {
    let valid = false
    const min = 3
    const max = 30
    const username = usernameEl.value.trim()
    if(!isRequired(username)){
        showError(usernameEl, "Username cannot be blank")
    }
    else {
        // usernameEl.parentElement.classList.remove("error")
        showSuccess(usernameEl)
        valid = true
    }
    return valid
    
}

// sign in 
function checkPassword() {
    let valid = false
    const password = passwordEl.value.trim()

    if(!isRequired(password)){
        showError(passwordEl, "Password cannot be blank")
    }
    else {
        showSuccess(passwordEl)
        valid = true
    }
    return valid
}



// sign up
function checkUsername2() {
    let valid = false
    const min = 3
    const max = 30
    const username = usernameEl_2.value.trim()
    if(!isRequired(username)){
        showError(usernameEl_2, "Username cannot be blank")
    }
    else if(document.getElementById("check-username").innerText == 'Username already exists') {
        showError(usernameEl_2,"")
    }
    else {
        showSuccess(usernameEl_2,"")
        valid = true
    }
    return valid
    
}

// sign up 
function checkEmail_2(){
    let valid = false
    const email = emailEl_2.value.trim()

    if(!isRequired(email)){
        showError(emailEl_2, "Email cannot be blank")
    }
    else if (!validateEmail(email)){
        showError(emailEl_2, "Email is invalid")
    }
    else {
        showSuccess(emailEl_2)
        valid = true
    }
    return valid
}



// sign up
function checkPassword_2() {
    let valid = false
    const password = passwordEl_2.value.trim()

    if(!isRequired(password)){
        showError(passwordEl_2, "Password cannot be blank")
        passwordEl_2.parentElement.classList.remove("requirement")

    }
    else if (!isPasswordSecure(password)){
        showError(passwordEl_2, "Password must contain least 8 characters, 1 lowercase, 1 uppercase and 1 special character")
        passwordEl_2.parentElement.classList.add("requirement")
        
    }
    else {
        showSuccess(passwordEl_2)
        valid = true
    }
    return valid
}


// sign up 
function checkConfirmPassword() {
    let valid = false
    const confirmPassword = confirmPasswordEl_2.value.trim()
    const password = passwordEl_2.value.trim()

    if(!isRequired(confirmPassword)){
        showError(confirmPasswordEl_2, "Confirm Password cannot be blank")
    }
    else if (confirmPassword !== password ){
        showError(confirmPasswordEl_2, "Passwords do not match")
    }
    else {
        showSuccess(confirmPasswordEl_2)
        valid = true
    }
    return valid
}



// sign up - check if RECAPTCHA has been checked

let recaptchaValid = false;
function isChecked() {
    if(grecaptcha && grecaptcha.getResponse().length !== 0) {
        recaptchaValid = true
        return recaptchaValid
    }
}





// common function
const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

// sign in
form1.addEventListener("submit", function(event) {
    event.preventDefault()

    
    let isUsernameValid = checkUsername1()
    let isPasswordValid = checkPassword()

    let isFormValid = isUsernameValid && isPasswordValid

    if(isFormValid){
        form1.submit()
    }
})

// sign in
form1.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username1':
            checkUsername1();
            break;
        case 'password1':
            checkPassword();
            break;
    }
}));


// sign up
form2.addEventListener("submit", function(event) {
    event.preventDefault()

    let isUsernameValid = checkUsername2()
    let isEmailValid = checkEmail_2()
    let isPasswordValid = checkPassword_2()
    let isConfirmPasswordValid = checkConfirmPassword()
    

    let isFormValid = isEmailValid && isPasswordValid && isUsernameValid && isConfirmPasswordValid && recaptchaValid

    if(!recaptchaValid){
        document.getElementById("recaptcha_error").style.display = ''
    }
    else {
        document.getElementById("recaptcha_error").style.display = 'none'
    }
    

    if(isFormValid){
        form2.submit()
    }
})

// sign up
form2.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username2':
            checkUsername2();
            break
        case 'email2':
            checkEmail_2();
            break;
        case 'password2':
            checkPassword_2();
            break;
        case 'confirmpassword2':
            checkConfirmPassword();
            break;
    }
}));
