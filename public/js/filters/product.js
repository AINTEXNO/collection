
import request from "../libs/request.js";

export default class Product {
    static request() {
        const search = window.location.search

        request(`/api/catalog/filters${search}`)
            .then(response => Product.render(response.data.products))
    }

    static render(products) {
        const element = document.querySelector('#products-list')
        let html = ``
        for(let product in products) html += Product.component(products[product])

        element.innerHTML = Object.keys(products).length ? html
            : `<div class="w-full flex justify-center py-4 bg-gray-50 text-gray-500 text-base col-span-4">Товары не найдены</div>`
    }

    static component(product) {
        return `
            <article class="flex flex-col relative">
                 <a href="/product/${product.id}" class="h-72 bg-gray-100 flex justify-center items-center">
                    <img src="/public/storage/${product.photo}" alt="${product.title}" class="w-3/4">
                 </a>
                <h2 class="text-lg mt-2">${product.title}</h2>
                <div class="flex items-end">
                    ${
                        product.discount
                        ?
                            `
                            <p class="text-lg font-medium mr-4">
                                 ${product.currentPrice}
                                 &#8381;
                            </p>
                            <p class="text-base text-gray-400 line-through mb-px">
                                 ${product.price} &#8381;
                            </p>
                            `
                        :
                            `<p class="text-lg font-medium">${product.price} &#8381;</p>`
                    }
                </div>
                    ${
                        product.discount
                            ?
                                `
                                    <span class="bg-green-200 text-green-500 text-xs rounded-md px-3 py-1 absolute top-2 left-2">-${product.discount}%</span>
                                    <span class="bg-indigo-400 text-white text-xs rounded-md px-3 py-1 absolute top-2 right-2">Акция</span>
                                `
                            :
                                ``
                    }
            </article>
        `
    }
}
