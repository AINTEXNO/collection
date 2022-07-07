
export default class Stats {
    static render(data) {
        this.data = data
        this.currentRating = this.calculateRating(data)
        this.element = document.querySelector('#review-stats')

        this.element.innerHTML = Stats.mainComponent(data)
    }

    static calculateRating(data) {
        if(data.length)
            return data.map(item => item.rating)
                        .reduce((amount, current) => amount + current) / data.length
        return 0
    }

    static renderStars(currentRating) {
        let html = ``
        for(let i = 0; i < 5; i++)
            html += i < currentRating ? Stats.starComponent(true) : Stats.starComponent(false)

        return html;
    }

    static starComponent(active) {
        return `
            <svg class="w-5 h-5 ${active ? 'text-yellow-300' : 'text-gray-300' }" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        `
    }

    static renderStatistics() {
        let html = ``
        for(let i = 5; i > 0; i--) {
            html += this.statisticsComponent(i)
        }
        return html;
    }

    static percent(number) {
        return this.statsObject()[number] ? (this.statsObject()[number] / this.data.length) * 100 : 0
    }

    static statisticsComponent(i) {
        return `
           <div class="flex items-center mt-4">
                <span class="text-sm font-medium text-indigo-600">${i}</span>
                <div class="w-full h-5 mx-4 bg-gray-100 rounded stat-line">
                    <div class="h-5 bg-indigo-400 rounded" style="width: ${this.percent(i)}%"></div>
                </div>
                <span class="text-sm font-medium text-indigo-600">${Math.round(this.percent(i))}%</span>
            </div>
        `
    }

    static statsObject() {
        const ratings = {1: 0, 2: 0, 3: 0, 4: 0, 5: 0}
        this.data.forEach(item => ratings[item.rating]++)
        return ratings
    }

    static mainComponent() {
        return `
            <div class="flex items-center mb-2">
                ${Stats.renderStars(this.currentRating)}
                <p class="ml-2 text-sm font-medium text-gray-900">${this.currentRating ? this.currentRating.toFixed(1) : '0'} из 5</p>
            </div>
            <p class="text-sm text-gray-400">На основании ${this.data.length} отзывов</p>
            ${Stats.renderStatistics()}
        `
    }
}
