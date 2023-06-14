import axios from 'axios'
const http = axios.create({
  baseURL: 'http://127.0.0.1:8000/'
})

const state = {
    getLista: []
}
  
const mutations = {
    setRegistros (state, data) {
        state.getLista = data
    }
}
  
const actions = {
    limparRegistros (context) {
        context.commit('setRegistros', [])
    },

    getRegistros (context, config) {
        http.get('api/' + config.resource).then(response => {
            context.commit('setRegistros', response.data.data)
        }).catch(e => 
            console.log(e)
        )
    },

    getRegistrosFilter (context, config) {
        if (!config.filtros) {
            config.filtros = []
        }

        http.get('api/' + config.resource, {params: config.filtros}).then(response => {
            context.commit('setRegistros', response.data.data)
        }).catch(e => 
            console.log(e)
        )
    },
}
  
  export default {
    state,
    mutations,
    actions
  }
  