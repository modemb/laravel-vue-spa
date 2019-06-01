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
  [types.DELETE_USER] (state, users) { 
    state.users = users.data    
  }
}

// actions
export const actions = {
  async deleteUser ({ commit }, id) {
    await axios.post(`/api/user/${id}`)
    commit(types.DELETE_USER, await axios.get('api/users'))       
  }
} 
 
