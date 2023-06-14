import { createRouter, createWebHistory } from 'vue-router'
import Fornecedor from '../pages/fornecedores/Fornecedor.vue'
import Material from '../pages/materiais/Material.vue'
import Vereador from '../pages/vereadores/Vereador.vue'
import Home from '../components/HelloWorld.vue'
import Logs from '../pages/logs/Logs.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  // fornecedores
  {
    path: '/fornecedores',
    name: 'Gerenciamento de Fornecedores',
    component: Fornecedor
  },
  //materiais
  {
    path: '/materiais',
    name: 'Materiais',
    component: Material
  },
  //vereadores
  {
    path: '/vereadores',
    name: 'Vereadores',
    component: Vereador
  },
  //logs
  {
    path: '/logs/:id/:table',
    name: 'Histórico de alterações',
    component: Logs
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
