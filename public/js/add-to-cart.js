
const product = document.querySelector('#product')
const button = document.querySelector('#add-button')

window.onload = function() {
    this.cart = JSON.parse(localStorage.getItem('cart'))

    if(this.cart?.hasOwnProperty(`+${button.dataset.id}`)) {
       markButton(button)
    }
}

product.onclick = function(event) {
    this.target = event.target
    this.cartInfo = this.querySelector('.cart-info')
    this.productInfo = this.cartInfo.children
    this.cart = JSON.parse(localStorage.getItem('cart')) || {}
    this.product = {}
    this.cartProduct = {}

    this.addToCart = function() {
        this.cartProduct[`+${this.product.id}`] = this.product

        if(!this.cart.hasOwnProperty(`+${this.product.id}`)) {
            localStorage.setItem('cart', JSON.stringify(Object.assign(this.cart, this.cartProduct)))
        }

        cartCounter()
        this.disabledButton()
    }

    this.hasItemInCart = function(item) {
        return this.cart.hasOwnProperty(item);
    }

    this.disabledButton = function() {
        button.innerText = 'Оформить заказ'
    }

    if(this.target.closest('#add-button')) {
        event.preventDefault();

        Array.from(this.productInfo).forEach(item => {
            this.product[item.name] = item.value
        })
        this.product['number'] = this.querySelector('#counter').value

        this.addToCart()
        markButton(button)
    }
}

function markButton(button) {
    button.innerHTML = 'Оформить заказ'
    button.classList.add('cart-btn--active')
    button.setAttribute('onclick', "window.location.href='/cart'")
    button.previousElementSibling.setAttribute('readonly', 'readonly')
}

