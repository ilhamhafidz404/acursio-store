<template>
    <div
        role="alert"
        class="alert mb-5"
        :class="{
            'alert-error': type == 'error',
            'alert-success': type == 'success',
            'alert-warning': type == 'warning',
        }"
    >
        <SuccessRibbonIcon
            v-if="type == 'success'"
            myClass="size-7 text-white"
        />
        <ErrorIcon v-else myClass="size-7 text-white" />
        <span class="text-white font-medium">{{ message }}</span>
    </div>
</template>

<script>
import SuccessRibbonIcon from "./../icon/successRibbon.vue";
import ErrorIcon from "./../icon/error.vue";
export default {
    props: {
        type: "error" | "success" | "warning",
        message: String,
    },
    components: { SuccessRibbonIcon, ErrorIcon },
};
</script>

<style></style>
