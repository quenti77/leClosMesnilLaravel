const moreBtn = document.querySelector(".moreBtn");
const lessBtn = document.querySelector(".lessBtn");
const nbAdult = document.getElementById("nb_adult");
const nbChildren = document.getElementById("nb_children");


function more() {
    lessBtn.classList.remove('disabled');
    nbAdult.value++;
    if(nbAdult.value >= 3) {
        moreBtn.classList.add('disabled');
    }
}

function less() {
    moreBtn.classList.remove('disabled');
    nbAdult.value--;
    if(nbAdult.value <= 1){
        lessBtn.classList.add('disabled');
    }
}

moreBtn.addEventListener("click",more);
lessBtn.addEventListener("click",less);
