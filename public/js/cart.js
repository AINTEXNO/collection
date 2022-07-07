
import request from "./libs/request.js";

const products = document.querySelector('#product-items')
let cart = document.querySelector('#cart-item')

document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart'))
    updateCartItems(cart)
})

function updateCartItems(cartItems) {
    let ids = []

    for(let item in cartItems) {
        ids.push(cartItems[item].id)
    }

    const response = request('/api/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json'
        },
        body: JSON.stringify({products: ids})
    })

    response.then(response => {
        if(response.status) {
            response.data.forEach(product => {
                let currentCartItem = cartItems[`+${product.id}`]
                currentCartItem.price = product.price
                currentCartItem.count = product.count

                if(product.discount) {
                    currentCartItem.discount = product.discount
                    currentCartItem.current = product.currentPrice
                }
                else {
                    delete currentCartItem.discount
                    delete currentCartItem.current
                }

                localStorage.setItem('cart', JSON.stringify(cartItems))
                renderProductItems()
                renderTotal()
            })
        }
    })
}


function currentCartLength() {
    return Object.keys(JSON.parse(localStorage.getItem('cart')) || {}).length
}

function renderProductItems() {
    let items = JSON.parse(localStorage.getItem('cart'))
    let html = ''

    for(let item in items) {
        let product = items[item]
        html +=
            `
                <div class="flex items-center px-6 py-5 item-product mb-2">
                    <div class="flex items-center w-2/6"> <!-- product -->
                        <div class="flex w-24 mr-10 min-image-width">
                            <a href="/product/${product.id}" class="w-full">
                                <img src="/public/storage/${product.photo}" alt="${product.title}" class="w-full min-w-full object-cover">
                            </a>
                        </div>
                        <div class="flex flex-col">
                            <a href="/product/${product.id}"><span class="font-normal text-base">${product.title}</span></a>
                            <span class="text-sm mb-2 text-gray-500 mt-1">${product.category}</span>
                        </div>
                    </div>
                    <div class="flex justify-center w-1/6">
                        <input type="number" class="mx-4 border text-center box-border w-16 pl-1 p-2 product-item-counter"
                        value="${product.number}" min="1" max="${product.count}" step="1" data-id="${product.id}" data-price="
                        ${
                            product.discount
                            ? product.current
                            : product.price
                        }">
                    </div>
                    <span class="text-center w-1/6 font-semibold text-sm">
                        ${
                            product.discount
                                ? numberWithSpaces(product.current)
                                : numberWithSpaces(product.price)
                        } &#8381;
                    </span>
                    <span class="text-center w-1/6 font-semibold text-sm product-counter">
                        ${
                            product.discount
                                ? totalPromotionItemPrice(product)
                                : totalItemPrice(product)
                        } &#8381;
                    </span>
                    <button class="bg-none block w-1/6 flex justify-center delete-cart-product" data-id="${product.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill delete-cart-product" viewBox="0 0 16 16" data-id="${product.id}">
                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                </div>
            `
    }

    products.innerHTML = ''
    products.insertAdjacentHTML('beforeend', html)
}

function totalItemPrice(product) {
    return numberWithSpaces(Number(product.price) * product.number)
}

function totalPromotionItemPrice(product) {
    return numberWithSpaces(Number(product.current) * product.number);
}

function renderTotal() {
    let inputs = cart.querySelectorAll('.product-item-counter')
    let summary = cart.querySelector('#summary')
    let html = ''

    html +=
        `
         <h2 class="text-lg text-gray-900 border-b pb-8">Стоимость заказа</h2>
            <div class="flex justify-between mt-10">
                <span class="font-normal text-sm uppercase">${currentCartLength()} Товара</span>
                <span class="font-normal text-sm">${numberWithSpaces(calculateTotalPrice(inputs))} &#8381;</span>
            </div>
            <div class="mt-2">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Итого</span>
                    <span>${numberWithSpaces(calculateTotalPrice(inputs))} &#8381;</span>
                </div>
                <form class="w-full flex justify-end mt-4" action="/order/create" method="GET">
                    <button class="px-6 py-2.5 text-sm bg-stone-800 rounded-full uppercase text-white ml-7 ${currentCartLength() ? '' : 'opacity-50' }" id="add-button">Оформить</button>
                </form>
            </div>
        `

    summary.innerHTML = html
}

function calculateTotalPrice(inputs) {
    let total = 0
    Array.from(inputs).forEach(item => {
        total += Number(item.dataset.price) * Number(item.value)
    })

    return total;
}

cart.oninput = function(event) {
    this.tg = event.target
    this.item = this.tg.closest('.item-product')
    this.total = this.item.querySelector('.product-counter')

    this.total.innerHTML = `${numberWithSpaces((Number(this.tg.dataset.price) * Number(this.tg.value)))} &#8381;`

    if(this.tg.closest('.product-item-counter')) {
        updateCountValue(this.tg.dataset.id, this.tg.value)
    }

    renderTotal()
}

cart.onclick = function(event) {
    this.tg = event.target

    if(this.tg.closest('.delete-cart-product')) {
        event.preventDefault()

        removeCartItem(this.tg.closest('.delete-cart-product').dataset.id)
        renderProductItems()
        renderTotal()
    }

    cartCounter()
}

function updateCountValue(id, value) {
    let cart = JSON.parse(localStorage.getItem('cart'))
    cart[`+${id}`].number = value
    localStorage.setItem('cart', JSON.stringify(cart))
}

function removeCartItem(item) {
    let cart = JSON.parse(localStorage.getItem('cart'))
    delete cart[`+${item}`]

    localStorage.setItem('cart', JSON.stringify(cart))
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
