
import Stats from "./stats.js";
import { productsCount, hideProgressButton } from "./reviews-handler.js";

export default class Review {
    static render(data, progress) {
        const progressData = data.slice(0, progress)

        if(progress > data.length) hideProgressButton()

        let html = ``
        for(let item in progressData) html += Review.component(progressData[item])

        const reviewsList = document.querySelector('#reviews-list')
        reviewsList.innerHTML = html
    }

    static component(data) {
        return `
            <article class="mb-6">
                <div class="flex items-center mb-4 space-x-4">
                    <img class="w-10 h-10 rounded-full object-cover" src="/public/storage/${data.user.photo}" alt="${data.user.name} ${data.user.surname}">
                    <div class="space-y-1 text-gray-500">
                        <p>${data.user.name} ${data.user.surname} <time datetime="2014-08-16 19:00" class="block text-sm text-gray-400">Оставлен ${data.created}</time></p>
                    </div>
                </div>
                <div class="flex items-center mb-1">
                    ${Stats.renderStars(data.rating)}
                </div>
                <p class="mb-2 font-light text-gray-500 dark:text-gray-400 text-justify">${data.text ?? ''}</p>
            </article>
        `
    }
}
