import { http } from '@/api/http'

export const login = (username, password) => {
    return http.post('auth/login', {
        username,
        password,
    })
}

export const register = (params) => {
    return http.post('auth/register', params)
}