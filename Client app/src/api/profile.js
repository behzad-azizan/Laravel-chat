import { http } from '@/api/http'

export const profile = () => {
    return http.get('profile')
}