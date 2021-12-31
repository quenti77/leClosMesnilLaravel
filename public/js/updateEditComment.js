/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/js/updateEditComment.js ***!
  \*******************************************/
var commentUpdates = document.querySelectorAll('.comment .update');
var cancelUpdates = document.querySelectorAll('.comment .cancelUpdate');

function onCommentUpdateHandler() {
  var commentId = this.dataset.comment;
  var commentEl = document.querySelector(".comment[data-comment=\"".concat(commentId, "\"]"));
  commentEl.querySelector('.contentInitial').classList.add('d-none');
  commentEl.querySelector('.action').classList.add('d-none');
  commentEl.querySelector('.commentForm').classList.remove('d-none');
}

function onCommentCancelHandler() {
  var commentId = this.dataset.comment;
  var commentEl = document.querySelector(".comment[data-comment=\"".concat(commentId, "\"]"));
  commentEl.querySelector('.contentInitial').classList.remove('d-none');
  commentEl.querySelector('.action').classList.remove('d-none');
  commentEl.querySelector('.commentForm').classList.add('d-none');
}

commentUpdates.forEach(function (updateBtn) {
  updateBtn.addEventListener('click', onCommentUpdateHandler);
});
cancelUpdates.forEach(function (cancelBtn) {
  cancelBtn.addEventListener('click', onCommentCancelHandler);
});
/******/ })()
;