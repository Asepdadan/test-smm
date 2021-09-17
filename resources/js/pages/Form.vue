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
                                <h5 class="card-title">Form Tambah Permintaan Barang</h5>
                                <div class="card-tools">
                                    <router-link exact :to="{ name: 'home' }" class="btn btn-warning"><i
                                        class="fa fa-arrow-left"></i>&nbsp; Kembali
                                    </router-link>
                                </div>
                            </div>

                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nik Peminta</label>
                                                <v-select name="pegawai_id" v-model="data.pegawai_id"
                                                          :options="dataPegawai.data" label="nik"
                                                          @input="setSelectedPegawai">
                                                    <template #option="{ nik,nama, departemen }">
                                                        <h3 style="margin: 0">{{ nik }}</h3>
                                                        <em>{{ nama }} - {{ departemen }}</em>
                                                    </template>
                                                </v-select>
                                                <ErrorMessage name="pegawai_id"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" placeholder="" v-model="nama"
                                                       disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <input type="text" class="form-control" placeholder=""
                                                       v-model="departemen" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Tanggal Permintaan</label><br>
                                                <date-picker v-model="data.tanggal" @input="changeDate"
                                                             format="DD MMM YYYY HH:mm:ss"
                                                             type="datetime"
                                                             valueType="format"></date-picker>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <tr class="text-center">
                                                    <th width="3%">#</th>
                                                    <th>Barang</th>
                                                    <th width="10%">Lokasi</th>
                                                    <th width="8%">Tersedia</th>
                                                    <th width="8%">Kuantiti</th>
                                                    <th width="10%">Satuan</th>
                                                    <th width="13%">Ketarangan</th>
                                                    <th width="10%">Status</th>
                                                    <th width="3%">*</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-if="barang.length < 1">
                                                    <td class="text-center" colspan="9">tidak ada data</td>
                                                </tr>
                                                <tr v-else v-for="(row, index) in barang" v-bind:key="index">
                                                    <td>{{ parseInt(index) + 1 }}</td>
                                                    <td>
                                                        <v-select v-model="row.barang_data_id"
                                                                  :reduce="dataBarang => dataBarang"
                                                                  :options="dataBarang.data" label="nama"
                                                                  @input="setSelectedBarang(index)">
                                                            <template #option="{ nama, lokasi, stok }">
                                                                <h3 style="margin: 0">{{ nama }}</h3>
                                                                <em>Lokasi: {{ lokasi }} - Stok: {{ stok }}</em>
                                                            </template>
                                                        </v-select>
                                                    </td>
                                                    <td><input type="text" class="form-control" v-model="row.lokasi"
                                                               disabled></td>
                                                    <td><input type="text" class="form-control" v-model="row.stok"
                                                               disabled></td>
                                                    <td><input type="number" class="form-control" v-model="row.qty"
                                                               @input="checkValidasiStok(index, row)"></td>
                                                    <td><input type="text" class="form-control" v-model="row.satuan"
                                                               disabled></td>
                                                    <td><input type="text" class="form-control"
                                                               v-model="row.keterangan"></td>
                                                    <td v-html="row.status"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger"
                                                                @click="removeBarang(index,row)"
                                                        ><i class="fa fa-cut"></i></button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="7"></td>
                                                    <td colspan="2" class="text-center">
                                                        <button type="button" @click="tambahElementBarang"
                                                                class="btn btn-success">Tambah
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="col-md-11">

                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary text-right" @click="submit()">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import Swal from 'sweetalert2'
import {mapActions, mapState} from "vuex";


export default {
    name: "FormPermintaan",
    components: {
        "v-select": vSelect,
        "date-picker": DatePicker,
    },
    data() {
        return {
            result1: "",
            nama: "",
            departemen: "",
            data: {
                pegawai_id: '',
                nik: '',
                tanggal: '',
                detail: []
            },
            barang: [],
        }
    },
    created() {
        this.getDataBarang()
        this.getDataPegawai()

    },
    computed: {
        ...mapState('barang', {
            dataBarang: state => state.barangs
        }),
        ...mapState('pegawai', {
            dataPegawai: state => state.pegawais
        }),

    },
    methods: {
        ...mapActions('barang', ['getDataBarang']),
        ...mapActions('pegawai', ['getDataPegawai']),
        ...mapActions('permintaan', ['submitPermintaan']),
        setSelectedPegawai(value) {
            this.nik = value.nik
            this.nama = value.nama
            this.departemen = value.departemen

            this.$store.commit('permintaan/ASSIGN_FORM', {
                pegawai_id: value.id,
                tanggal: this.tanggal
            })
        },
        setSelectedBarang(index) {
            let value = this.barang[index].barang_data_id
            this.barang[index].barang_id = value.id
            this.barang[index].lokasi = value.lokasi
            this.barang[index].stok = value.stok
            this.barang[index].satuan = value.satuan
            this.barang[index].status = value.status
        },
        tambahElementBarang() {
            this.barang.push({
                barang_id: '',
                qty: '',
                keterangan: ''
            })
        },
        removeBarang(index, barang) {
            const indexArray = this.barang.indexOf(barang);
            if (indexArray > -1) {
                this.barang.splice(indexArray, 1);
            }
            console.log(this.barang, index, indexArray)
        },
        checkValidasiStok(index, barang) {
            console.log(barang, index)
            if (barang.qty > barang.barang_data_id.stok) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Kuantiti tidak boleh lebih dari stok',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.barang[index].qty = 0
                    } else if (result.isDenied) {
                        this.barang[index].qty = 0
                    }
                })
            }
        },
        changeDate(value) {
            console.log(this.$store.state.permintaan.permintaan.pegawai_id, this.data)
            this.$store.commit('permintaan/ASSIGN_FORM', {
                pegawai_id: this.$store.state.permintaan.permintaan.pegawai_id,
                tanggal: value
            });
        },
        checkStok() {
            this.barang.forEach(function (element, index) {
                if (element.stok == 0 || element.stok == "") {
                    Swal.fire({
                        title: 'Error!',
                        text: element.barang_data_id.nama+' Stok tidak tersedia',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })

                    return false;
                }

                if (element.qty == 0 || element.qty == "") {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Kuantiti '+element.barang_data_id.nama+' wajib di isi',
                        icon: 'error',
                        confirmButtonText: 'Cool'
                    })

                    return false;
                }
            })

            return true;
        },
        async submit() {
            let payload = {
                pegawai_id: this.data.pegawai_id.id,
                tanggal: this.data.tanggal,
                detail: this.barang
            }

            if (!this.data.pegawai_id.id) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Nik wajib di pilih',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })

                return false
            }

            if (!this.data.tanggal) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Tanggal wajib di pilih',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })

                return false
            }

            if (this.barang.length < 1) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Barang wajib di tambah',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })

                return false
            }

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "data akan tersimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Tidak, Simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submitPermintaan(payload).then((response) => {
                        console.log(response)
                        Swal.fire({
                            title: response.code,
                            text: response.message,
                            icon: response.code,
                        }).then(() => {
                            if (response.code == "success") {
                                this.$router.push({path: "/"})
                            }
                        })
                    })
                }
            })
        },
    }
}
</script>

<style scoped>

</style>
