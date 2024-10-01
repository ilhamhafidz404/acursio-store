<template>
    <Navbar />
    <div class="px-5 md:px-10 xl:px-20 mb-10 min-h-screen">
        <router-view></router-view>
    </div>
    <Footer />
</template>

<script>
import Navbar from "./components/navbar/index.vue";
import Footer from "./components/footer/index.vue";
export default {
    components: { Navbar, Footer },
    name: "App",
};
</script>

<style></style>
