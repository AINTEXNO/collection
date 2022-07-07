
const favoritesButton = document.querySelector('#add-to-favorites')

document.addEventListener('DOMContentLoaded', () => {
    if(unload().hasOwnProperty(`+${favoritesButton.dataset.id}`)) {
        favoritesButton.classList.add('border-indigo-600')
        favoritesButton.firstElementChild.classList.add('fill-indigo-600')
    }
})

document.onclick = function(event) {
    this.target = event.target;
    this.favorites = unload() || {}
    this.btn = favoritesButton

    this.toObject = function(arr) {
        let obj = {}
        arr.forEach(item => {obj[item.name] = item.value})
        return obj;
    }

    this.saveToLocalStorage = function(item) {
        localStorage.setItem('favorites', JSON.stringify(item))
        favoritesCounter()
    }

    this.deleteLocalStorageItem = function(id) {
        delete this.favorites[`+${id}`]
        this.saveToLocalStorage(this.favorites)
    }

    if(this.target.closest('#add-to-favorites')) {
        this.btn.classList.toggle('border-indigo-600')
        this.btn.firstElementChild.classList.toggle('fill-indigo-600')

        if(this.favorites.hasOwnProperty(`+${this.btn.dataset.id}`))
            return this.deleteLocalStorageItem(this.btn.dataset.id)

        this.productData = this.toObject(Array.from(this.querySelectorAll('.cart-info__input')))
        this.favorites[`+${this.productData.id}`] = this.productData;

        this.saveToLocalStorage(this.favorites)
    }
}

function unload() {
    return JSON.parse(localStorage.getItem('favorites'))
}
