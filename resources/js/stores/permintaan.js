import $axios from '../api.js'

const state = () => ({
    permintaans: [],
    permintaan: {
        no_transaksi: '',
        tanggal: '',
        pegawai_id : '',
    },
    page: 1,
    currentPerPage: 10
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.permintaans = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_CURRENT_PERPAGE(state, payload) {
        state.currentPerPage = payload
    },
    ASSIGN_FORM(state, payload) {
        state.permintaan = {
            no_transaksi: payload.no_transaksi,
            tanggal: payload.tanggal,
            pegawai_id: payload.pegawai_id,
        }
    },
    CLEAR_FORM(state) {
        state.permintaan = {
            no_transaksi: '',
            tanggal: '',
        }
    }
}

const actions = {
    getData({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/permintaan?page=${state.page}&q=${search}&perpage=${state.currentPerPage}`)
                .then((response) => {
                    commit('ASSIGN_DATA', response.data)
                    resolve(response.data)
                })
        })
    },
    submitPermintaan({ dispatch, commit, state }, payload) {
        return new Promise((resolve, reject) => {
            console.log(payload)
            $axios.post(`/permintaan`, payload)
                .then((response) => {
                    dispatch('getData').then(() => {
                        resolve(response.data)
                    })
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        commit('SET_ERRORS', error.response.data.errors, { root: true })
                    }
                })
        })
    },
    getDataBarang({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/barang?q=${search}`)
                .then((response) => {
                    commit('ASSIGN_DATA_BARANG', response.data)
                    resolve(response.data)
                })
        })
    },
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}
