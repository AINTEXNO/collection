
import request from "./libs/request.js";

const shops = document.querySelector('#shops')
const shopsList = document.querySelector('#shops-list')
const shopsData = request(`api/shops/all`);

shops.addEventListener('input', searchShop)

function searchShop(event) {
    this.target = event.target;

    if(this.target.closest('#shops-input')) {
        shopsData.then(response => {
            const shops = filterData(response.data.shops, this.target.value.trim())
            renderList(shops)
        })
    }
}

function filterData(data, value) {
    return data.filter(item => item.city.title.toLowerCase().includes(value.toLowerCase()))
}

function renderList(data) {
    let html = ``
    for(let item in data) html += component(data[item])
    shopsList.innerHTML = data.length ? html
        : `<div class="w-full flex justify-center py-4 bg-gray-50 text-gray-500 text-base col-span-4">Магазины не найдены</div>`
}

function component(data) {
    return `
         <div class="w-full flex justify-start items-start border border-gray-100 p-6 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="mr-6" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
            <div class="flex flex-col">
                <h3 class="text-gray-900 text-lg font-medium">${data.title}</h3>
                <p class="text-gray-500 text-base">${data.address}</p>
                <p class="text-gray-400 text-sm mt-3">${data.address}</p>
                <p class="text-gray-500 text-sm mt-px">${data.phone_number}</p>
            </div>
        </div>
    `
}

