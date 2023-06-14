<template>
  <div class="row">
        <DashboardComponent />
    </div>
</template>

<script>
import DashboardComponent from '@/components/DashboardComponent.vue';

export default {
  name: 'AppView',
  watch: {
    '$route' () {
      this.$store.dispatch('limparRegistros')
    }
  },
  components: {
    DashboardComponent,
  }
}
</script>