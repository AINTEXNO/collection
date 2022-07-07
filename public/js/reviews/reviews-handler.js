
import { openModal, closeModal } from "./modal.js";
import request from "../libs/request.js";
import Review from "./review.js";
import Stats from "./stats.js";

const reviewsSection = document.querySelector('#reviews-section')
const progressButton = document.querySelector('#progress-button')
// Количество отзывов на странице
let productsCount = 4
let currentProgress = productsCount

reviewsSection.addEventListener('click', handler)
document.addEventListener('DOMContentLoaded', load)

function handler(event) {
    this.target = event.target

    if(this.target.closest('#open-modal'))
        openModal()

    if(this.target.closest('#review-modal') && !this.target.closest('.modal__form'))
        closeModal()

    if(this.target.closest('#progress-button')) {
        event.preventDefault()
        progressButton.dataset.progress++

        const progress = progressButton.dataset.progress
        currentProgress = productsCount * progress

        request(`/api/reviews/${reviewsSection.dataset.product}`)
            .then(response => {
                Review.render(response.data.reviews, currentProgress)
            })
    }
}

function load() {
    request(`/api/reviews/${reviewsSection.dataset.product}`)
        .then(response => {
            Review.render(response.data.reviews, currentProgress)
            Stats.render(response.data.reviews)

            if(response.data.reviews.length <= 4) hideProgressButton()
        })
}

function hideProgressButton() {
    progressButton.style.display = 'none'
}

export { productsCount, hideProgressButton, currentProgress }
