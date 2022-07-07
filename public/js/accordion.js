
const menu = document.querySelector('#accordion-menu')

menu.addEventListener('click', accordion)

function accordion(event) {
    this.target = event.target

    if(this.target.closest('.filter-item')) {
        this.list = this.target.parentNode.querySelector('ul.filter-list')
        this.list.classList.contains('active') ? hide(this.list) : show(this.list)
    }
}

function show(list) {
    list.style.height = `${list.scrollHeight}px`
    list.classList.add('active')
}

function hide(list) {
    list.style.height = `0px`
    list.classList.remove('active')
}
