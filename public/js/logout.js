
const header = document.querySelector('#action-menu')

header.onclick = function(event) {
    this.target = event.target

    if(this.target.closest('#logout-btn')) {
        this.link = this.target.closest('#logout-btn')
        localStorage.removeItem('api_token')
        window.location.href = this.link.href
    }
}

