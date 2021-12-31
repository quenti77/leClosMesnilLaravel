/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/counterButton.js ***!
  \***************************************/
var moreBtn = document.querySelector(".moreBtn");
var lessBtn = document.querySelector(".lessBtn");
var nbAdult = document.getElementById("nb_adult");
var nbChildren = document.getElementById("nb_children");

function more() {
  lessBtn.classList.remove('disabled');
  nbAdult.value++;

  if (nbAdult.value >= 3) {
    moreBtn.classList.add('disabled');
  }
}

function less() {
  moreBtn.classList.remove('disabled');
  nbAdult.value--;

  if (nbAdult.value <= 1) {
    lessBtn.classList.add('disabled');
  }
}

moreBtn.addEventListener("click", more);
lessBtn.addEventListener("click", less);
/******/ })()
;