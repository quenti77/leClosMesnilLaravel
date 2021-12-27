const password = document.getElementById("password");
const eye = document.querySelector(".fa-eye")
const progress = document.querySelector(".progress-bar");
const msg = document.querySelector(".msg");
const validated = document.querySelector(".is-invalid .is-invalid")

const parameters = {
    count : false,
    lowers : false,
    uppers : false,
    numbers : false,
    special : false
}

function showHidePassword() {
    if (password.type === "password") {
        password.type = "text";
        eye.classList.remove("fa-eye")
        eye.classList.add("fa-eye-slash")
    } else {
        password.type = "password";
        eye.classList.remove("fa-eye-slash")
        eye.classList.add("fa-eye")
    }
}
eye.addEventListener("click",showHidePassword);

function passwordCheck() {
    const val = password.value;
    parameters.letters = (/[A-Za-z]+/.test(val));
    parameters.numbers = (/[0-9]+/.test(val));
    parameters.special = (/[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(val));
    parameters.count = (val.length >= 8);
    let scoring = 0;
    const weak = 0;
    const medium = 0;
    const good = 0;

    if(parameters.count)
    {
        scoring +=10;
    }
    if (parameters.letters) {
        scoring += 5;
    }
    if (parameters.numbers) {
        scoring += 5;
    }
    if (parameters.numbers && parameters.numbers){
        scoring += 10;
    }
    if (parameters.special) {
        scoring += 20;
    }
    progress.classList.remove("w-100","w-50","w-25");
    progress.classList.remove("bg-danger", "bg-success","bg-warning");

    if(scoring === 50){
        progress.classList.add("bg-success","w-100")
    }
    if(scoring >= 30 && scoring < 50){
        progress.classList.add("bg-warning", "w-50")
    }
    if(scoring >= 15 && scoring < 30) {
        progress.classList.add("bg-danger", "w-25");
    }
    if(scoring < 15){
        progress.classList.add("w-0")
    }
    console.log(scoring)
}
password.addEventListener("input",passwordCheck);

