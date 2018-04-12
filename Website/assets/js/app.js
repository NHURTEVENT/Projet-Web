function containsUpperCase(str) {
    console.log("UC");
    return (/[A-Z]/.test(str));
}

function containsNumber(str) {
    console.log("NB");
    return (/[0-9]/.test(str));
}

function passwordCheck() {
    var password = document.getElementById('password').value;

    if(password.length >= 6 && containsNumber(password) && containsUpperCase(password)) {
        document.getElementById('valid').innerHTML = "OK";
        console.log("OK");
    } else {
        document.getElementById('valid').innerHTML = "NTM";
        console.log("NTM");
    }
}
