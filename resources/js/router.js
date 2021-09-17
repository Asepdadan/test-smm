import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Index.vue'
import FormPermintaan from './pages/Form.vue'
import store from './store.js'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },{
            path: '/permintaan/create',
            name: 'permintaan.create',
            component: FormPermintaan
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
            next()
    } else {
        next()
    }
})

export default router
