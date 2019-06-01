// import Cookies from 'js-cookie'
import axios from 'axios'
import * as types from '../mutation-types'

axios.get('api/users').then(response => {
  state.users = response.data        
}) 

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
    console.log(users);  
  }
}

// actions
export const actions = {
  async fetchUsers ({ commit }) {
    try {
      const { data } = await axios.get('/api/users')

      commit(types.FETCH_USERS_SUCCESS, { users: data })
    } catch (e) {
      commit(types.FETCH_USERS_FAILURE)
    }
  }
}
 
