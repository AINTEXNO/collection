
const loginForm = document.querySelector('#login-form')

loginForm.addEventListener('submit', submitLoginForm)

function submitLoginForm (event) {
    event.preventDefault();

    this.fields = Array.from(this.querySelectorAll('.login-field'))
    this.data = (obj = {}) => {
        this.fields.forEach(item => obj[item.name] = item.value)
        return obj;
    }

    this.response = async (url, params = {}) => await (await (fetch(url, params))).json()

    this.params = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.data())
    }

    this.response('/api/user/authentication', this.params)
        .then(response => {
            console.log(response)
            if(response.status) localStorage.setItem('api_token', response.token)
        })
        .then(this.submit())

    return true;
}
