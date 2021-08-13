import Vue from 'vue'
import Vuex from 'vuex'

import AuthModule from './AuthModule'
import ChatModule from './ChatModule'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    auth: AuthModule,
    chat: ChatModule
  },
  state: {
    loading: false,
    error: null,
      accessToken: null,
  },
  mutations: {
    setLoading (state, payload) {
      state.loading = payload
    },
    setError (state, payload) {
      state.error = payload
    },
    clearError (state) {
      state.error = null
    },
      setAccessToken (state, accessToken) {
        state.accessToken = accessToken
          localStorage.setItem('access_token', accessToken)
      },
      logout (state) {
          localStorage.removeItem('access_token')
          state.accessToken = null
      }
  },
  actions: {
    clearError ({commit}) {
      commit('clearError')
    }
  },
  getters: {
    loading (state) {
      return state.loading
    },
    error (state) {
      return state.error
    },
      accessToken (state) {
        return state.accessToken
      }
  }
})
