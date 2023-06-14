import { createStore } from 'vuex'
import Fornecedor from '@/store/modules/fornecedor.js'
import Pagination from '@/store/modules/pagination.js'

// export default createStore({
//   state: {
//   },
//   getters: {
//   },
//   mutations: {
//   },
//   actions: {
//   },
//   modules: {
//   }
// })

export default createStore({
  modules: {
    fornecedor: Fornecedor,
    pagination: Pagination
  }
})
