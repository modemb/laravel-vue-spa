// import Cookies from 'js-cookie'
import * as types from '../mutation-types'

const { locale, locales } = window.config

// state
export const state = {
  users: null
}

// getters
export const getters = {
  users: state => state.users,
}

// mutations
export const mutations = {

  [types.FETCH_USERS_SUCCESS] (state, { users }) {
    state.users = users
  },

  // [types.FETCH_USER_FAILURE] (state) {
  //   state.token = null
  //   Cookies.remove('token')
  // },
}

// actions
export const actions = {
  async fetchUser ({ commit }) {
    try {
      const { data } = await axios.get('/api/users')

      commit(types.FETCH_USERS_SUCCESS, { users: data })
    } catch (e) {
      commit(types.FETCH_USERS_FAILURE)
    }
  }
}
