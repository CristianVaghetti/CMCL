<template>
    <div class="col-2">
        <SidebarComponent />
    </div>
    <div class="col-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" v-for="li in list" :key="li.name"><a :href=li.path>{{ li.name }}</a></li>
            </ol>
        </nav>
        <div class="container-fluid">
            <RouterView />
            <FooterComponent />
        </div>
    </div>
</template>
  
<script>
    import FooterComponent from './FooterComponent.vue';
    import SidebarComponent from './SidebarComponent.vue';
    export default {
        name: 'DashboardComponent',

        components: {
            SidebarComponent,
            FooterComponent,
        },

        computed: {
            list () {
                return this.$route.matched.filter((route) => route.name || route.meta.label)
            }
        }
    }
</script>

<style scoped>
/* @import '@coreui/icons/css/coreui-icons.min.css'; */
</style>
