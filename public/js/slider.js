
import request from "./libs/request.js";

class Slider {
    constructor(slider) {
        this.slider = slider
        this.counter = 0

        slider.onclick = this.control.bind(this)
    }

    control(event) {
        const target = event.target;
        const response = request(`/api/promotions/${3}`)
        response.then(response => {
            if(response.status) {
                const content = response.data;

                if(target.closest('#prev-btn')) {
                    this.counter > 0 ? this.counter-- : this.counter = Object.keys(content).length - 1;
                    this.render(this.counter, content)
                }

                if(target.closest('#next-btn')) {
                    this.counter < Object.keys(content).length - 1 ? this.counter++ : this.counter = 0;
                    this.render(this.counter, content)
                }
            }
        })
    }

    render(step, content) {
        this.slider.firstElementChild.innerHTML = ''

        const html =
            `
            <div class="slider-content">
                <h3 class="slider-subtitle slider-content__subtitle">Новая акция</h3>
                <h2 class="slider-title slider-content__title">${content[step].title}</h2>
                <a href="/promotions/${content[step].id}" class="view-more slider-content__btn">Подробнее</a>
            </div>
            <img src="/public/storage/${content[step].promo_photo}" alt="${content[step].title}" class="slider-image">
            `

        this.slider.firstElementChild.insertAdjacentHTML('afterbegin', html)
    }
}

const slider = document.querySelector('.slider');
new Slider(slider)
