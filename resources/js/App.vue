<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
import DealerSearch from './components/dealer/search'

export default {
    name: "App",
    components: {
        'dealer-search': DealerSearch
    }
}
</script>

<style scoped>

</style>
