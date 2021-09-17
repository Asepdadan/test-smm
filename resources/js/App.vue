<template>
    <div>
        <app-header />
        <app-sidebar />
        <router-view></router-view>
        <app-footer />
    </div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
import AppHeader from "./components/Header.vue";
import AppSidebar from "./components/Sidebar.vue";
import AppFooter from "./components/Footer.vue";
export default {
    computed: {

    },
    components: {
        AppHeader,
        AppSidebar,
        AppFooter
    }
};
</script>
