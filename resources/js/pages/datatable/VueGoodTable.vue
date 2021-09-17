<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="permintaans.data"
            :totalRows="permintaans.total"
            max-height="500px"
            :line-numbers="true"
            :isLoading.sync="isLoading"
            @on-page-change="onPageChange"
            @on-per-page-change="onPageChange"
            :search-options="{
                enabled: true,
                placeholder: 'Cari data dari tabel ini',
              }"
            :pagination-options="{
            enabled: true,
            mode: 'records',
            nextLabel: 'Selanjutnya',
            prevLabel: 'Sebelumnya',
            perPage: 10,
            rowsPerPageLabel: 'Menampilkan Data Perhalaman',
            infoFn: (params) => `Menampilkan ${params.firstRecordOnPage} sampai ${params.lastRecordOnPage} dari halaman ${params.currentPage}`,
          }"
        />
    </div>
</template>

<script>
import {VueGoodTable} from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
import {mapActions, mapState} from 'vuex'
import moment from "moment";

export default {
    components: {
        VueGoodTable,
    },
    name: 'vuetablegood',
    data() {
        return {
            isLoading: false,
            rows: [],
            totalRecords: 0,
            columns: [
                {
                    label: 'No Transaksi',
                    field: 'no_transaksi',
                },
                {
                    label: 'Nama Pegawai',
                    field: 'pegawai.nama',
                },
                {
                    label: 'Total Barang',
                    field: 'details.length',
                    width: '100px',
                },
                {
                    label: 'Tanggal',
                    field: 'tanggal',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'd MMM Y',
                    width: '150px',
                },
                {
                    label: 'Created At',
                    field: 'created_at',
                    type: 'datetime',
                    dateInputFormat: 'yyyy-MM-dd hh:ii:ss',
                    dateOutputFormat: 'd MMM Y H:i:s',
                    formatFn: this.formatFn,
                    width: '250px',
                },
            ],
            search: ''
        };
    },
    created() {
        this.getData()

    },
    watch: {},

    computed: {
        ...mapState('permintaan', {
            permintaans: state => state.permintaans
        }),
        page: {
            get() {
                return this.$store.state.permintaans.page
            },
            set(val) {
                this.$store.commit('permintaan/SET_PAGE', val)
            }
        }
    },
    methods: {
        ...mapActions('permintaan', ['getData']),
        myFunc(row, col, cellValue, searchTerm) {
            this.search = searchTerm
            this.getData(this.search)
        },
        onPageChange(params) {
            this.$store.commit('permintaan/SET_PAGE', params.currentPage)
            this.$store.commit('permintaan/SET_CURRENT_PERPAGE', params.currentPerPage)
            console.log(this.$store.state.permintaan.page, params)
            this.getData()
        },
        formatFn: function (value) {
            return moment(value).format("D MMMM YYYY H:mm:ss")
        }
    }
};
</script>

<style scoped>

</style>
