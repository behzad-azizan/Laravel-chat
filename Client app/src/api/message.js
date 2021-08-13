import { http } from '@/api/http'

export const sendMessage = (params) => {
    return http.post('message/send', params)
}

export const messages = (user2, user1) => {
    return http.get(`message/${user1}/${user2}/list`)
}