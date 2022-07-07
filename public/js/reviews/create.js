
import getCurrentRating from "../rating-select.js"
import request from "../libs/request.js";
import Review from "./review.js";
import { closeModal } from "./modal.js";
import Stats from "./stats.js";
import { currentProgress, productsCount } from "./reviews-handler.js";

const form = document.querySelector('#create-review')

form.addEventListener('submit', sendReview)

function sendReview(event) {
    event.preventDefault();

    if(getCurrentRating()) {
        this.body = {
            rating: getCurrentRating(),
            text: this.querySelector('#review-text').value,
            product_id: this.querySelector('#product-id').value,
            api_token: localStorage.getItem('api_token')
        }

        const req = request('/api/review/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(this.body)
        })

        req.then(response => {
            if(response.status) {
                closeModal()
                Review.render(response.data.reviews, currentProgress)
                Stats.render(response.data.reviews)
            }
        })
    }
}
