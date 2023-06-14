import axios from 'axios'
const http = axios.create({
  baseURL: 'http://127.0.0.1:8000/'
})

const state = {
    lista: []
  }
  
  const mutations = {
    setFornecedores (state, data) {
      state.lista = data
    }
  }
  
  const actions = {
    getFornecedores (context) {
      http.get('api/fornecedor').then(response => {
        context.commit('setFornecedores', response.data.data)
      })
    }
  }
  
  export default {
    state,
    mutations,
    actions
  }
  