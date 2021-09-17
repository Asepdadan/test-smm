<template>
    <aside class="main-sidebar sidebar-primary elevation-4" style="background: black !important;color:white !important;">
        <a href="index3.html" class="brand-link">

            <span class="brand-text font-weight-light text-white">SMM</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">

                </div>
                <div class="info">
                    <a href="#" class="d-block text-white">{{ '' }}</a>
                </div>
            </div>

            <nav class="mt-2" style="color: white !important;">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <li class="nav-item">
                        <router-link exact :to="{ name: 'home' }" class="nav-link text-white">
                            <i class="nav-icon fas fa-table purple"></i>
                            <p>Daftar Permintaan</p>
                        </router-link>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import { mapState } from "vuex";
export default {

    computed: {


    },
    methods: {
        logout() {
            return new Promise((resolve, reject) => {
                localStorage.removeItem("token");
                resolve();
            }).then(() => {
                this.$store.state.token = localStorage.getItem("token");
                this.$router.push("");
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
