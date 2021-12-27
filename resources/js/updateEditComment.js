const commentUpdates = document.querySelectorAll('.comment .update')
const cancelUpdates = document.querySelectorAll('.comment .cancelUpdate')

function onCommentUpdateHandler() {
    const commentId = this.dataset.comment

    const commentEl = document.querySelector(`.comment[data-comment="${commentId}"]`)
    commentEl.querySelector('.contentInitial').classList.add('d-none')
    commentEl.querySelector('.action').classList.add('d-none')
    commentEl.querySelector('.commentForm').classList.remove('d-none')
}

function onCommentCancelHandler() {
    const commentId = this.dataset.comment

    const commentEl = document.querySelector(`.comment[data-comment="${commentId}"]`)
    commentEl.querySelector('.contentInitial').classList.remove('d-none')
    commentEl.querySelector('.action').classList.remove('d-none')
    commentEl.querySelector('.commentForm').classList.add('d-none')
}

commentUpdates.forEach((updateBtn) => {
    updateBtn.addEventListener('click', onCommentUpdateHandler)
})

cancelUpdates.forEach((cancelBtn) => {
    cancelBtn.addEventListener('click', onCommentCancelHandler)
})
