
const favoritesItemsBlock = document.querySelector('#favorites-items')

document.addEventListener('DOMContentLoaded', function() {
    this.favorites = JSON.parse(localStorage.getItem('favorites'))
    favoritesItemsBlock.innerHTML = renderFavoritesItems(this.favorites)
})

function renderFavoritesItems(favorites) {
    this.html = ``
    for(let favorite in favorites) {
        this.item = favorites[favorite]
        this.html +=
            `
            <div class="w-1/2 flex justify-start items-start py-6 pr-16 mb-2">
                <a href="/product/${this.item.id}" class="w-40 h-36 flex justify-center items-center bg-gray-50 rounded-md p-5 mr-8">
                    <img src="/public/storage/${this.item.photo}" alt="${this.item.title}" class="1/2 object-cover">
                </a>
                <div class="w-4/5 h-40 flex flex-col justify-between">
                    <div class="w-full flex flex-col">
                        <div class="w-full flex justify-between items-center">
                            <h2 class="font-medium text-gray-900">${this.item.title}</h2>
                            <p class="font-medium text-gray-900">${this.item.price} &#8381;</p>
                        </div>
                        <p class="text-base font-normal text-justify mt-1.5 text-gray-400 t-overflow">${this.item.description}</p>
                    </div>
                </div>
            </div>
            `
    }
    return this.html;
}
