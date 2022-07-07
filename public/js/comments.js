
import request from "./libs/request.js";

const comments = document.querySelector('#comments')
const commentsContent = document.querySelector('#comments-list')
const commentSelect = document.querySelector('#comments-filter')

comments.addEventListener('click', deleteComment)
commentSelect.addEventListener('input', filterComments)

function filterComments() {
    this.filter = this.value
    const commentsPromise = request(`/api/comments/${comments.dataset.id}`)

    commentsPromise.then(
        response => {
            if(response.status)
                commentsContent.innerHTML = renderComments(sort(response.data.comments, this.filter))
        }
    )
}

function sort(arr, parameter = 1) {
    return arr.sort((a, b) => parameter == 1 ? b.id - a.id : a.id - b.id)
}

function deleteComment(event) {
    this.target = event.target;

    if(this.target.closest('#delete-comment-btn')) {
        this.id = this.target.closest('#delete-comment-btn').dataset.id
        this.params = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'api_token': localStorage.getItem('api_token'),
                'comment_id': this.id,
                'post_id': comments.dataset.id
            })
        }

        request('/api/comment/delete', this.params)
            .then(response => {
                if(response.status) {
                    commentsContent.innerHTML = renderComments(sort(response.data.comments, commentSelect.value))
                    commentsCounter()
                }
            })
    }
}

comments.onsubmit = function(event) {
    event.preventDefault()

    this.target = event.target;
    this.fields = Array.from(this.querySelectorAll('.comments-field'))
    this.textarea = this.querySelector('#comment-text')

    this.toObject = function() {
        this.obj = {}
        this.fields.forEach(item => this.obj[item.name] = item.value)
        return this.obj;
    }

    this.params = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.assign(this.toObject(this.fields), {'api_token': localStorage.getItem('api_token')}))
    }

    if(validateCommentsForm(this.textarea))
        request('/api/comments/store', this.params)
            .then(response => {
                if(response.status) {
                    commentsContent.innerHTML = renderComments(sort(response.data.comments, commentSelect.value))
                    this.textarea.value = ''
                    commentsCounter()
                    clearValidField(this.textarea)
                }
            })
    else
        markInvalidField(this.textarea)
}

function renderComments(comments) {
    let html = ``
    for (let comment in comments) {
        let item = comments[comment]
        html +=
            `
                 <div class="w-full flex justify-start mb-10">
                    <img src="/public/storage/${item.photo}" alt="${item.name}" class="post-img-sm rounded-full overflow-hidden object-cover">
                    <div class="w-full flex-col items-start ml-6">
                        <div class="w-full flex justify-between items-center">
                            <h3 class="text-base">${item.name}</h3>
                            <div class="text-base text-gray-400 flex items-center relative">
                                ${
                                    item.author == localStorage.getItem('api_token')
                                    ?
                                        ` <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill mr-3 mt-px hover:fill-red-500 cursor-pointer duration-200" data-id="${item.id}" id="delete-comment-btn" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                        `
                                    : ``
                                }
                                <p class="text-base text-gray-400">${item.created}</p>
                            </div>
                        </div>
                        <p class="text-base text-gray-500 text-justify mt-1">${item.text}</p>
                    </div>
                </div>
                `
    }
    return html
}

function validateCommentsForm(field) {
    return field.value.length && field.value.length > 3 && field.value.length < 400;
}

function markInvalidField(field) {
    field.classList.add('invalid-field')
    field.nextElementSibling.classList.remove('hidden')
    field.nextElementSibling.innerHTML = 'Недопустимая длина комментария'
}

function clearValidField(field) {
    field.classList.remove('invalid-field')
    field.nextElementSibling.classList.add('hidden')
    field.nextElementSibling.innerHTML = ''
}

function commentsCounter() {
    let counter = document.querySelector('#comments-counter')
    counter.innerHTML = `${commentsContent.children.length} комментариев`
}
