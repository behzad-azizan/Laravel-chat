import {store} from '../store/index'
import {profile} from "../api/profile";

export default async (to, from, next) => {
    try{
        if (localStorage.getItem('access_token'))
            await store.commit('setAccessToken', localStorage.getItem('access_token'))

        const res = await profile()
        await store.commit('setUser', res.data.data.profile)
        await next()
    }catch (e) {
        await next('/login')
    }
}
