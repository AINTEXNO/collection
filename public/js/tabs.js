
const tabs = document.querySelector('#tabs')
const tabsElements = Array.from(document.querySelectorAll('.tab-item'))
const tabsItems = Array.from(document.querySelectorAll('.tab-element'))

tabs.addEventListener('click', handle)

function handle(event) {
    this.target = event.target

    if(this.target.closest('.tab-element')) {
        this.id = this.target.closest('.tab-element').dataset.tab
        this.tab = document.querySelector(this.id)

        clearActiveElements(tabsElements)
        clearActiveElements(tabsItems)

        this.tab.classList.add('active-tab')
        this.target.closest('.tab-element').classList.add('tab-element--active')
    }
}

function clearActiveElements(elements) {
    elements.forEach(item => item.classList.remove('active-tab', 'tab-element--active'))
}
