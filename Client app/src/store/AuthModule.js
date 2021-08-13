import {login, register} from "../api/auth";
import Router from '../router';

const AuthModule = {
  state: {
    user: null
  },
  mutations: {
      setUser(state, user) {
          state.user =  user
      },
  },
  actions: {
    signUserUp ({commit}, payload) {
      commit('setLoading', true)
      commit('clearError')
        register(payload)
            .then(res => {
                commit('setUser', res.data.data.user)
            }).catch(error => {
                commit('setError', error)
            }).finally(() => {
                commit('setLoading', false)
            })
    },
    signUserIn ({commit}, payload) {
      commit('setLoading', true)
      commit('clearError')
        try {
            login(payload.username, payload.password)
                .then(async (res) => {
                    commit('setAccessToken', res.data.data.access_token)
                    commit('setUser', res.data.data.user)
                    window.location.href = 'chats'
                }).catch(e => {
                    commit('setError', {message : "نام کاربری یا رمز عبور نامعتبر است"})
                })

        } catch (err) {
            commit('setError', {message : "نام کاربری یا رمز عبور نامعتبر است"})
        }finally {
            commit('setLoading', false)
        }
    }
  },
  getters: {
      user (state) {
          return state.user
      }
  }
}

export default AuthModule
