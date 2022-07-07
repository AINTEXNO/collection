
export default class Validator {
    rules
    errors = []
    _value
    _element
    messages
    attributes

    constructor(form) {
        this.form = form
    }

    setMessages(messages) {
        this.messages = messages
    }

    setAttributes(attributes) {
        this.attributes = attributes
    }

    check(rules, messages = {}) {
        this.rules = rules
        this.messages ||= messages

        Object.keys(this.rules).forEach(key => {
            const currentElement = this.form.querySelector(`[name="${key}"]`) || false
            const currentRules = this.rules[`${key}`].split('|')

            this._element = currentElement
            this._value = currentElement.value

            currentRules.forEach(rule => {
                const split = rule.split(':')
                const check = this[`${split[0]}`](split[1])

                if(currentElement && !check)
                    this.errors.push({[key]: {
                        name: key,
                        element: currentElement,
                        message: this.searchMessage(key, split[0]),
                        rule: rule
                    }})
            })
        })

        return this.errors
    }

    formElements() {
        const formElements = {}
        const elements = this.form.querySelectorAll(`[name]`)

        Array.from(elements).forEach(element => formElements[element.name] = element)

        return formElements;
    }

    searchMessage(key, rule) {
        const variants = [this.messages[`${key}.${rule}`], this.messages[key], this.messages[rule]]
        return variants.map(variant => this.replace(variant, key)).filter(variant => Boolean(variant))[0] || ''
    }

    errorsOnly() {
        return this.errors.map(element => element[Object.keys(element)[0]].message)
            .filter(element => Boolean(element))
    }

    invalidElements() {
        return this.errors.map(element => {
            return [element[Object.keys(element)[0]].element, element[Object.keys(element)[0]].message]
        })
    }

    replace(str, key) {
        return str && str.replace(`:attribute`, this.attributes[`${key}`] || key)
    }

    // validation rules

    required() {
        return this._element.type === 'checkbox' ? this._element.checked : this._value.trim().length
    }

    min(number) {
        return this._value.length > 0 ? String(this._value).length > number : true
    }

    max(number) {
        return this._value.length > 0 ? String(this._value).length < number : true
    }

    email() {
        return this._value.length > 0 ? Boolean(this._value.match(/\S+@\S+\.\S+/)) : true
    }

    confirmed() {
        const confirmation = this.form.querySelector(`[name="${this._element.name}_confirmation"]`)
        return this._value.trim() === confirmation.value.trim()
    }

    regex(exp) {
        return this._value.length > 0 ? this._value.trim().match(new RegExp(`^${exp}$`), 'i') : true
    }
}
