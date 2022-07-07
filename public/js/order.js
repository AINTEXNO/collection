
import Validator from "./libs/validator.js";

const details = document.querySelector('#order-details')
const order = document.querySelector('#order-app')

const rules = {
    surname: 'required|min:2|max:30',
    name: 'required|min:2|max:30',
    email: 'required|email|min:5|max:40',
    address: 'required|min:2|max:120',
}
const attributes = {
    surname: 'фамилия',
    name: 'имя',
    email: 'email',
    address: 'адрес',
}
const messages = {
    required: "Поле :attribute обязательно для заполнения",
    min: "Минимальная длина поля :attribute 2 символа",
    'surname.max': 'Максимальная длина поля :attribute 30 символов',
    'name.max': 'Максимальная длина поля :attribute 30 символов',
    'email.max': 'Максимальная длина поля :attribute 40 символов',
    'address.max': 'Максимальная длина поля :attribute 40 символов',
    email: 'Недопустимый формат для поля :attribute'
}

window.onload = function() {
    this.cart = JSON.parse(localStorage.getItem('cart'))
    this.html = ''

    this.html =
        `
            <div class="flex justify-between border-b pb-8">
                <h2 class="text-lg text-gray-900">Детали заказа</h2>
            </div>
            <ul class="w-full flex flex-col mt-6">
        `

    for(let item in this.cart) {
        this.html +=
            `
                <li class="w-full flex justify-between mb-2">
                    <p class="text-base">${this.cart[item].title}</p>
                    <p class="text-base">
                        ${
                            this.cart[item].discount
                            ? numberWithSpaces(this.cart[item].current)
                            : numberWithSpaces(this.cart[item].price)
                        } &#8381; x ${this.cart[item].number}шт.</p>
                </li>
            `
    }

    this.html +=
        `
             </ul>
             <div class="text-lg font-medium flex items-center mt-4">
                <p>Итого:</p>
                <p class="ml-3">${numberWithSpaces(calculateTotal())} &#8381;</p>
             </div>
             <input type="hidden" name="total" class="create-order-input" value="${calculateTotal()}">
             <div class="w-full flex justify-end mt-8">
                 <button class="px-6 py-2.5 text-sm bg-stone-800 rounded-full uppercase text-white ml-7" id="create-order-btn">Оформить заказ</button>
             </div>
        `

    details.innerHTML = ''
    details.insertAdjacentHTML('beforeend', this.html)
}

order.onclick = function(event) {
    this.tg = event.target
    this.cart = JSON.parse(localStorage.getItem('cart'))
    this.dataInputs = order.querySelectorAll('.create-order-input')
    this.fields = this.querySelector('#fields')
    this.validator = new Validator(this.fields)
    this.body = {}

    this.validator.setAttributes(attributes)
    this.validator.setMessages(messages)

    this.productsList = function() {
        this.res = {}
        for(let item in this.cart) {
            this.res[this.cart[item].id] = this.cart[item].number
        }
        return this.res
    }

    if(this.tg.closest('#create-order-btn')) {
        if(!this.validator.check(rules).length) {
            Array.from(this.dataInputs).forEach(item => {
                this.body[item.name] = item.value
            })
            this.body['products'] = this.productsList()

            fetch('/api/order/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.body)
            }).then(response => {
                response.json().then(data => {
                    if(response.status) {
                        renderModal(data.params)
                        localStorage.removeItem('cart')
                    }
                })
            })

            let elements = this.validator.formElements()
            for(let item in elements) {
                elements[item].classList.remove('border-red-400')
            }

            return true
        }

        this.validator.invalidElements().forEach(item => {
            item[0].classList.add('border-red-400')
        })
    }

    cartCounter()
}

function calculateTotal() {
    let cart = JSON.parse(localStorage.getItem('cart'))
    let res = 0
    for(let item in cart)
        if(cart[item].discount)
            res += (Number(cart[item].current) * Number(cart[item].number))
        else
            res += (Number(cart[item].number) * Number(cart[item].price))

    return res;
}

function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function renderModal(params) {
    let html =
        `
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Ваш заказ успешно создан</h3>
                                <p class="text-mb mt-3">Номер заказа: ${params.code}</p>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Всю информацию по данному заказу вы сможете увидеть в личном кабинете</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form action="/product" method="GET">
                            <button class="px-6 py-2.5 text-sm bg-stone-800 rounded-full uppercase text-white">Продолжить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `

    order.insertAdjacentHTML('beforeend', html);
}
