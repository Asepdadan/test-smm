import $axios from '../api.js'

const state = () => ({
    pegawais: [],
    pegawai: {
        nik: '',
        nama: '',
        departemen: '',
    },
    page: 1,
    currentPerPage: 2
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.pegawais = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_CURRENT_PERPAGE(state, payload) {
        state.currentPerPage = payload
    },
}

const actions = {
    getDataPegawai({ commit, state }, payload) {
        let search = typeof payload != 'undefined' ? payload:''
        return new Promise((resolve, reject) => {
            $axios.get(`/pegawai?q=${search}&perpage=${state.currentPerPage}`)
                .then((response) => {
                    commit('ASSIGN_DATA', response.data)
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
