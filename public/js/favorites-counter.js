
const favoritesCounterItem = document.querySelector('#favorites-counter')

function favoritesCounter() {
    this.favorites = JSON.parse(localStorage.getItem('favorites')) || {}
    this.length = Object.keys(this.favorites).length

    favoritesCounterItem.innerHTML = `Избранное (${this.length})`
}

favoritesCounter()
