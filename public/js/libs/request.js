
export default async function request(url, params = {}) {
    return await (await fetch(url, params)).json()
}
