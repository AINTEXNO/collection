
const counter = document.querySelector('#cart-counter')

function cartCounter() {
    this.cart = JSON.parse(localStorage.getItem('cart')) || {}
    this.length = Object.keys(this.cart).length

    counter.innerHTML = `Корзина (${this.length})`
}

cartCounter()
