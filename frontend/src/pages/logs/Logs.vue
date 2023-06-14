<template>
    <div class="container">
        <div class="card-reader mt-4">
            <div class="row p-2 bd-highlight">
                <div class="col-9">
                    <h3><strong>{{$route.name}}</strong></h3>
                </div>

                <div class="col-3">
                    <button style="float: right" @click="this.$router.go(-1)" class="btn btn-warning">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<span>Voltar</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row mt-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Data/Hora</th>
                            <th scope="col">Atualização</th>
                            <th scope="col">Detalhamento</th>
                        </tr>
                    </thead>
                    <tbody v-if="logs && logs.length > 0">
                        <tr class="action" v-for="(log, index) in logs" :key="index">
                            <td>{{ log.datac }}</td>
                            <td>{{ log.descricao }}</td>
                            <td style="width: 1%; white-space: nowrap; text-align: center;">
                                <button @click="show(log.dados)" v-if="log.dados !== null" class="btn btn-primary action" title="Detalhar" data-bs-toggle="modal" data-bs-target="#modalLog">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else><tr>Não há logs</tr></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade modal-lg" id="modalLog" tabindex="-1" aria-labelledby="modalLogLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLogLabel">Detalhamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body form-group">
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th tabindex="0" scope="col">Dados Anteriores</th>
                                    <th tabindex="0" scope="col">Dados Após Alteração</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td tabindex="0"><br>
                                    <p v-for="(attr, index) in old" :key="'velho-' + index">
                                        <span><strong>{{ index }}</strong>: {{ attr }}</span>
                                    </p>
                                </td>
                                <td tabindex="0"><br>
                                    <p v-for="(attr, index) in novo" :key="'velho-' + index">
                                        <span><strong>{{ index }}</strong>: {{ attr }}</span>
                                    </p>
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    export default {
        name: 'LogsView',

        created () {
        },

        mounted () {
            this.getLogs(this.$route.params.id, this.$route.params.table)
        },

        computed: {
        },

        watch: {
        },

        data() {
            return {
                logs: [],
                old: null,
                novo: null
            }
        },

        methods: {
            getLogs (id, table) {
                this.$http.get('api/log?obj_id=' + id + '&table=' + table).then(res => {
                    this.logs = res.data.data
                }).catch(() => {
                    this.$toast.error("API BACKEND OFFLINE!")
                })
            },
            show (dados) {
                let dadosObj = JSON.parse(dados)
                this.old = dadosObj.antes
                this.novo = dadosObj.depois
            }
        }
    }
</script>
