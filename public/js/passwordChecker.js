const password = document.getElementById("password");
const hidden = document.querySelector(".fa-eye")
const progress = document.querySelector(".progress-bar");

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
        hidden.classList.remove("fa-eye")
        hidden.classList.add("fa-eye-slash")
    } else {
        password.type = "password";
        hidden.classList.remove("fa-eye-slash")
        hidden.classList.add("fa-eye")
    }
}

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
