<template>
    <div class="pt-28 mb-5">
        <router-link
            to="/account-store"
            class="btn btn-ghost btn-sm inline-flex text-primary"
        >
            <LongArrowLeftIcon myClass="size-6" />

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
