
const modal = document.querySelector('#review-modal')

function openModal() {
    modal.classList.add('modal--active')
}

function closeModal() {
    modal.classList.remove('modal--active')
}

export { closeModal, openModal }
