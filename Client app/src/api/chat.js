import { http } from '@/api/http'

export const chats = () => {
  return http.get('chats')
}