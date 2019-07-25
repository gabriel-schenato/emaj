<template>
    <v-flex xs12>
        <v-card>
            <v-toolbar card color="white">
                <v-btn color="primary" dark @click="adicionar">Adicionar
                    <v-icon right dark>add</v-icon>
                </v-btn>

                <avaliacao-dialog ref="avaliacaoDialog"></avaliacao-dialog>
                <confirm ref="confirm"></confirm>
                <v-divider class="mx-2" inset vertical></v-divider>
                <v-text-field
                    flat
                    clearable
                    solo
                    prepend-icon="search"
                    placeholder="Buscar..."
                    v-model="search"
                    hide-details
                    class="hidden-sm-and-down"
                    ></v-text-field>
            </v-toolbar>
            <v-divider></v-divider>
            <v-card-text class="pa-0">
                <v-data-table
                    :headers="complex.headers"
                    :search="search"
                    :items="items"
                    :rows-per-page-items="[5,10,15,{text:'Todos','value':-1}]"
                    class="elevation-1"
                    item-key="id"
                    rows-per-page-text="Linhas por página"
                    no-results-text="Nenhum registro correspondente encontrado"
                    no-data-text="Não há registros para serem exibidos."
                    disable-initial-sort
                    :loading="loading"
                    >
                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.id }}</td>
                        <td>{{ props.item.ficha_triagem.dados_ficha_triagem }}</td>
                        <td>{{ props.item.avaliador.dados_usuario }}</td>
                        <td>{{ props.item.data | formataData}}</td>
                        <td>
                        <v-btn depressed outline icon fab dark color="primary" small>
                            <v-icon @click="editar(props.item.id)">edit</v-icon>
                        </v-btn>
                        <v-btn depressed outline icon fab dark color="pink" small>
                            <v-icon @click="deletar(props.item)">delete</v-icon>
                        </v-btn>
                        </td>
                    </template>

                    <template
                        slot="pageText"
                        slot-scope="props"
                        >Mostrando {{ props.pageStart }} - {{ props.pageStop }} de {{ props.itemsLength }}</template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-flex>
</template>
<script>
    import Confirm from "@/components/dialogs/Confirm.vue";
    import AvaliacaoDialog from "@/components/cadastro/dialogs/AvaliacaoDialog.vue";
    import moment from 'moment'

    export default {
        name: "avaliacoes-table",
        components: {
            Confirm,
            AvaliacaoDialog
        },
        props: {
            value: {
                type: [Array]
            },
            idAluno: {
                type: Number
            }
        },
        data() {
            return {
                search: "",
                complex: {
                    selected: [],
                    headers: [
                        {
                            text: "ID",
                            value: "id"
                        },
                        {
                            text: "Ficha de Triagem",
                            value: "ficha_triagem.dados_ficha_triagem"
                        },
                        {
                            text: "Avaliador",
                            value: "avaliador.dados_usuario"
                        },
                        {
                            text: "Data",
                            value: "data"
                        },
                        {
                            text: "Ação",
                            value: "",
                            sortable: false
                        }
                    ]
                },
                items: [],
                loading: false
            };
        },
        created() {
            this.initialize();
        },
        watch: {
            value: {
                handler() {
                    this.items = this.value;
                },
                deep: true
            }
        },
        methods: {
            initialize() {
                this.items = this.value;
            },
            adicionar() {
                this.$refs.avaliacaoDialog
                        .open(
                                'Adicionar uma nova Avaliação do Aluno',
                                {data: moment().format('YYYY-MM-DD'), aluno_id: this.idAluno},
                                {
                                    color: "blue"
                                }
                        ).then(confirm => {
                    if (confirm)
                        this.getData();
                });
            },
            editar(id) {
                this.$store.dispatch("getAvaliacao", id).then(() => {
                    this.$refs.avaliacaoDialog
                            .open(
                                    'Editar um Avaliação do Aluno',
                                    this.$store.state.avaliacao.avaliacaoView,
                                    {
                                        color: "blue"
                                    }
                            ).then(confirm => {
                        if (confirm)
                            this.getData();
                    });
                });
            },
            deletar(item) {
                this.$refs.confirm
                        .open("Deletar", "Você tem certeza que deseja deletar essa Avaliação do Aluno?", {
                            color: "red"
                        })
                        .then(confirm => {
                            if (confirm) {
                                this.$store.dispatch("removeAvaliacao", item).then(() => {
                                    window.getApp.$emit("APP_SUCCESS", {msg: 'Deletado com sucesso!', timeout: 2000});
                                    this.getData();
                                }).catch((resp) => {
                                    let msgErro = '';
                                    if (resp.response.data.errors)
                                        msgErro = resp.response.data.errors;
                                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                                });
                            }
                        });
            },
            getData() {
                this.loading = true;
                window.axios.get('avaliacoes-aluno/' + this.idAluno).then((resp) => {
                    this.items = resp.data;
                    this.loading = false;
                }).catch((resp) => {
                    this.loading = false;
                    let msgErro = '';
                    if (resp.response.data.errors)
                        msgErro = resp.response.data.errors;
                    window.getApp.$emit("APP_ERROR", {msg: 'Ops! Ocorreu algum erro. ' + msgErro, timeout: 4500});
                }).finally(() => (this.loading = false));
            }
        }
    };
</script>