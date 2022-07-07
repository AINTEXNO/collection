
function confirmation(event) {
    if(!confirm('Подтвердите действие на странице'))
        event.preventDefault()
}
