// import Cookies from 'js-cookie'
import axios from 'axios'
import Swal from 'sweetalert2'
import * as types from '../mutation-types'

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
  [types.FETCH_USERS] (state, users) { 
    state.users = users.data    
  }
}

// actions
export const actions = {  
  async getUser ({ commit }) {
    commit(types.FETCH_USERS, await axios.get('api/users')) 
  },
  deleteUser ({ commit }, id) {

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(async result => {
      if (result.value) {       

        await axios.post(`/api/user/${id}`)

        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
        
        commit(types.FETCH_USERS, await axios.get('api/users'))
      }
    })




       
  }
} 
 
