<template>
    <Navbar />
    <div class="px-5 md:px-10 xl:px-20">
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from "./components/navbar/index.vue";
export default {
    components: { Navbar },
    name: "App",
};
</script>

<style></style>
