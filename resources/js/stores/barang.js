import $axios from '../api.js'

const state = () => ({
    barangs: [],
    barang: {
        kode: '',
        nama: '',
        lokasi: '',
        status: '',
        terpenuhi: '',
    },
    page: 1,
    currentPerPage: 2
})

const mutations = {
    ASSIGN_DATA(state, payload) {
        state.barangs = payload
    },
    SET_PAGE(state, payload) {
        state.page = payload
    },
    SET_CURRENT_PERPAGE(state, payload) {
        state.currentPerPage = payload
    },
}

const actions = {
    getDataBarang({commit, state}, payload) {
        let search = typeof payload != 'undefined' ? payload : ''
        return new Promise((resolve, reject) => {
            $axios.get(`/barang?q=${search}&perpage=${state.currentPerPage}`)
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
