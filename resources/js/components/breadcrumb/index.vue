<template>
    <div class="md:pt-28 pt-24 md:mb-5">
        <router-link
            to="/"
            class="btn btn-ghost btn-sm inline-flex text-primary md:text-base text-xs"
        >
            <LongArrowLeftIcon myClass="md:size-6 size-4" />

            Kembali
        </router-link>
    </div>
</template>

<script>
import LongArrowLeftIcon from "../../components/icon/longArrowLeft.vue";
export default {
    components: {
        LongArrowLeftIcon,
    },
};
</script>

<style></style>
