<template>
    <div
        role="alert"
        class="alert mb-5 block"
        :class="{
            'alert-error': type == 'error',
            'alert-success': type == 'success',
            'alert-warning': type == 'warning',
        }"
    >
        <div
            class="flex md:flex-row flex-col font-bold gap-2 md:justify-start justify-center items-center"
        >
            <SuccessRibbonIcon
                v-if="type == 'success'"
                myClass="size-7 text-white"
            />
            <ErrorIcon v-else myClass="md:size-7 size-6 text-white" />
            <span
                class="text-white font-medium md:text-base text-sm"
                v-html="message"
            ></span>
        </div>
        <div v-if="description" class="mt-3">
            <p
                class="md:text-sm text-xs text-gray-100"
                v-html="description"
            ></p>
        </div>
    </div>
</template>

<script>
import SuccessRibbonIcon from "./../icon/successRibbon.vue";
import ErrorIcon from "./../icon/error.vue";
export default {
    props: {
        type: "error" | "success" | "warning",
        message: String,
        description: "",
    },
    components: { SuccessRibbonIcon, ErrorIcon },
};
</script>

<style></style>
