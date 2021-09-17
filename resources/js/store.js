import Vue from 'vue'
import Vuex from 'vuex'

//IMPORT MODULE SECTION
import permintaan from './stores/permintaan.js'
import barang from './stores/barang.js'
import pegawai from './stores/pegawai.js'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        permintaan,
        barang,
        pegawai,
    },
    state: {
        token: localStorage.getItem('token'),
        errors: []
    },
    getters: {
        isAuth: state => {
            return state.token != "null" && state.token != null
        }
    },
    mutations: {
        SET_TOKEN(state, payload) {
            state.token = payload
        },
        SET_ERRORS(state, payload) {
            state.errors = payload
        },
        CLEAR_ERRORS(state) {
            state.errors = []
        }
    }
})

export default store
