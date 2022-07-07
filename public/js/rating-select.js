
const rating = document.querySelector('#rating-select')
const stars = Array.from(rating.querySelectorAll('.rating-star'))
const sendButton = document.querySelector('#create-review-btn')
let currentRating = 0

rating.addEventListener('click', ratingSelect)
rating.addEventListener('mouseover', starsMark)
rating.addEventListener('mouseout', clear)

function starsMark(event) {
    this.target = event.target

    if(this.target.closest('.rating-star')) {
        this.rating = this.target.closest('.rating-star').dataset.rating
        mark(this.rating)
    }
}

function ratingSelect(event) {
    this.target = event.target

    if(this.target.closest('.rating-star')) {
        currentRating = this.target.closest('.rating-star').dataset.rating
        sendButton.classList.remove('button-disabled')

        mark(currentRating)
        clear()
    }
}

function clear() {
    stars.slice(currentRating, stars.length).forEach(star => star.classList.remove('text-yellow-300'))
}

function mark(rating) {
    stars.slice(0, rating).forEach(star => {
        star.closest('.rating-star').classList.add('text-yellow-300')
    })
}

export default function getCurrentRating() {
    return currentRating;
}

