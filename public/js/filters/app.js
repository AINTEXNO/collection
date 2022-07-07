
import Product from "./product.js";

document.addEventListener('DOMContentLoaded', load)

const filtersElement = document.querySelector('#filters')
let aliases;

filtersElement.addEventListener('input', filters)

function load() {
    const search = window.location.search
    localStorage.setItem('filters', JSON.stringify({}))
    const obj = {}

    if(search) {
        const query = search.replace(/[?]/, '')
        const parts = query.split('&')

        parts.forEach(part => {
            const split = part.split('=')
            const name = split[0]
            const values = split[1]

            obj[name] = values.split('_')
        })
    }

    localStorage.setItem('filters', JSON.stringify(obj))
    aliases = JSON.parse(localStorage.getItem('filters'))

    checkedActiveInputs()
    Product.request()
}

function filters(event) {
    this.target = event.target
    this.name = this.target.name
    this.alias = this.target.dataset.alias

    if(this.target.checked)
        aliases.hasOwnProperty(this.name) ? aliases[this.name].push(this.alias) : aliases[this.name] = [this.alias]

    if(!this.target.checked) {
        const params = aliases[this.name]
        params.splice(params.indexOf(this.alias), 1)

        if(!params.length) delete aliases[this.name]
    }

    filterParamsToLocalStorage()

    createQueryString()
    Product.request()
}

function createQueryString() {
    let query = `?`
    for(let item in aliases) query += `${item}=${aliases[item].join('_')}&`
    return setQueryString(query);
}

function setQueryString(query) {
    return history.pushState(null, null, getParamsLength() ? query.slice(0, -1) : query);
}

function getParamsLength() {
    return Object.keys(aliases).length
}

function filterParamsToLocalStorage() {
    localStorage.setItem('filters', JSON.stringify(aliases))
}

function checkedActiveInputs() {
    const checkboxes = Array.from(filtersElement.querySelectorAll("input[type='checkbox']"))
    const filters = JSON.parse(localStorage.getItem('filters'))

    checkboxes.forEach(checkbox => {
        const key = filters[checkbox.name] || []
        if(key.includes(checkbox.dataset.alias)) {
            checkbox.setAttribute('checked', true)
        }
        if(key.length) {
            const list = checkbox.closest('ul')

            list.style.transition = `0s linear`
            list.style.height = `${list.scrollHeight}px`
            list.classList.add('active')
        }
    })
}
