<template>
    <div class="container">
        <div class="card-reader mt-4">
            <div class="row p-2 bd-highlight">
                <div class="col-9">
                    <h3><strong>{{$route.name}}</strong></h3>
                </div>

                <div class="col-3">
                    <button style="float: right" @click="cadastrar" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalForm">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<span>Cadastrar</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <span class="input-group-text">Nome</span>
                        <input v-model="filtros.nome" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group">
                        <span class="input-group-text">CPNJ</span>
                        <input v-maska data-maska="##.###.###/####-##" v-model="filtros.cnpj" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-4" >
                    <div class="input-group" style="background-color: var(--bs-tertiary-bg);">
                        <span class="input-group-text">Situação</span>
                        <div class="form-check form-check-inline mt-2 mx-4">
                            <input v-model="filtros.situacao" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" :value=true>
                            <label class="form-check-label" for="inlineRadio1">Ativo</label>
                        </div>

                        <div class="form-check form-check-inline mt-2">
                            <input v-model="filtros.situacao" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" :value=false>
                            <label class="form-check-label" for="inlineRadio2">Inativo</label>
                        </div>

                        <div class="form-check form-check-inline mt-2 mx-2">
                            <input v-model="filtros.situacao" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" :value=null>
                            <label class="form-check-label" for="inlineRadio3">Ambos</label>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-1">
                    <button @click="pesquisar" class="btn btn-primary">Pesquisar</button>
                </div>

                <div class="col-1">
                    <button @click="limparFitros" class="btn btn-secondary">Limpar</button>
                </div>
            </div>

            <div class="row mt-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">Situação</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody v-if="fornecedores && fornecedores.length > 0">
                        <tr class="action" v-for="(fornecedor, index) in fornecedores" :key="index">
                            <td>{{ fornecedor.nome }}</td>
                            <td>{{ fornecedor.cnpj }}</td>
                            <td v-if="fornecedor.situacao"><button class="btn btn-sm btn-success rounded-pill" disabled>Ativo</button></td>
                            <td v-else><button class="btn btn-sm btn-danger rounded-pill" disabled>Inativo</button></td>
                            <td style="width: 1%; white-space: nowrap;">
                                <button @click="editar(fornecedor)" class="btn btn-sm btn-primary action mx-1" title="Editar" data-bs-toggle="modal" data-bs-target="#modalForm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button @click="toggle(fornecedor.id)" v-if="fornecedor.situacao" class="btn btn-sm btn-primary action mx-1" title="Desativar">
                                    <i class="bi bi-toggle-off"></i>
                                </button>
                                <button @click="toggle(fornecedor.id)" v-else class="btn btn-sm btn-secondary action mx-1" title="Ativar">
                                    <i class="bi bi-toggle-on"></i>
                                </button>
                                <button @click="historico(fornecedor.id)" class="btn btn-sm btn-primary action mx-1" title="Histórico">
                                    <i class="bi bi-list-ol"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else><tr>Nenhum fornecedor encontrado</tr></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">{{nomeModal}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text w-25">Nome</span>
                        <input v-model="form.nome" type="text" class="form-control" placeholder="Nome da empresa">
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text w-25">CNPJ</span>
                        <input v-maska data-maska="##.###.###/####-##" v-model="form.cnpj" type="text" class="form-control" placeholder="CNPJ da empresa">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button @click="salvar" type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    const filtrosVazio = {
        nome: null,
        cnpj: null,
        situacao: null
    }

    const formVazio = {
        id: null,
        nome: null,
        cnpj: null,
        situacao: true
    }

    export default {
        
        name: 'FornecedorView',

        created () {
            this.$store.dispatch('getRegistros', {resource: this.resource})
        },

        computed: {
            fornecedores () {
                return this.$store.state.pagination.getLista
            }
        },
        watch: {
        },

        data() {
            return {
                nomeModal: null,
                resource: 'fornecedor',
                form: {...formVazio},
                filtros: {...filtrosVazio},
            }
        },

        methods: {
            toggle (id) {
                this.$http.get('api/fornecedor/toggle/' + id).then(res => {
                    this.$toast.success(res.data.msg)
                    this.$store.dispatch('getRegistros', {resource: this.resource})
                }).catch(e => {
                    if (e.response !== undefined) {
                        this.$toast.error(e.response.data.msg)
                    } else {
                        this.$toast.error("API BACKEND OFFLINE!")
                    }
                })
            },
            historico (id) {
                this.$router.push('/logs/' + id + '/fornecedores')
            },
            cadastrar () {
                this.nomeModal = 'Cadastrar Fornecedor'
                this.form = {...formVazio}
            },
            salvar () {
                this.$http.post('api/fornecedor', this.form).then(res => {
                    this.$toast.success(res.data.msg)
                    this.$store.dispatch('getRegistros', {resource: this.resource})
                }).catch(e => {
                    if (e.response !== undefined) {
                        this.$toast.error(e.response.data.msg)
                    } else {
                        this.$toast.error("API BACKEND OFFLINE!")
                    }
                })
            },
            pesquisar () {
                this.$store.dispatch('getRegistrosFilter', {resource: this.resource, filtros: this.filtros})
                this.$toast.info('FILTRO APLICADO!', {
                    autoClose: 1000,
                })
            },
            limparFitros () {
                this.filtros = {...filtrosVazio}
                this.pesquisar()
            },
            editar (fornecedor) {
                this.nomeModal = 'Editar Fornecedor'
                this.form = {...fornecedor}
            }
        }
    }
</script>
