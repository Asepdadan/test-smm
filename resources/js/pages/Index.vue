<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ 'Permintaan' }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header ui-sortable-handle">
                                <h5 class="card-title">Daftar Permintaan</h5>
                                <div class="card-tools">
                                    <router-link exact :to="{ name: 'permintaan.create' }" class="btn btn-info"><i
                                        class="fa fa-plus"></i>&nbsp; Tambah Permintaan
                                    </router-link>
                                </div>
                            </div>
                            <div class="card-body">
                                <vuetablegood></vuetablegood>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Vuetable from 'vuetable-2'
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
import VueTable from './VueTable'
import VueGoodTable from './datatable/VueGoodTable'

export default {
    name: "app",
    components: {
        'vuetablegood': VueGoodTable,
        'myvuetable': VueTable,
        'vuetable': Vuetable,
        'vuetable-pagination': VuetablePagination
    },
    data() {
        return {
            sortOrder: [
                {
                    field: 'name',
                    sortField: 'name',
                    direction: 'asc'
                }
            ],
            fields: [
                {
                    name: 'name',
                    title: `<span class="icon orange"><i class="fa fa-user"></i></span> Full Name`,
                    sortField: 'name'
                },
                {
                    name: 'email',
                    title: 'Email',
                    sortField: 'email'
                },
                'birthdate', 'nickname',
                {
                    name: 'gender',
                    title: 'Gender',
                    sortField: 'gender'
                },
                'actions'
            ],
        }
    },
    computed: {
        /*httpOptions(){
          return {headers: {'Authorization': "my-token"}} //table props -> :http-options="httpOptions"
        },*/
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.vuetable.changePage(page)
        },
        editRow(rowData) {
            alert("You clicked edit on" + JSON.stringify(rowData))
        },
        deleteRow(rowData) {
            alert("You clicked delete on" + JSON.stringify(rowData))
        },
        onLoading() {
            console.log('loading... show your spinner here')
        },
        onLoaded() {
            console.log('loaded! .. hide your spinner here')
        }
    }
}
</script>

<style lang="scss" scoped>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    margin-top: 20px;
}

button.ui.button {
    padding: 8px 3px 8px 10px;
    margin-top: 1px;
    margin-bottom: 1px;
}

h2 {
    margin-top: 20px !important;
    margin-bottom: 10px;
}

.orange {
    color: orange;
}

th.sortable {
    color: #ec971f;
}

span.icon.sort-icon {
    float: right;
}
</style>

