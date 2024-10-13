<template>
    <dialog id="informationDialog" class="modal">
        <div class="modal-box">
            <div class="flex gap-2 items-center">
                <SuccessRibbonIcon
                    v-if="type == 'success'"
                    myClass="size-7 text-success"
                />
                <ErrorIcon v-else myClass="size-7 text-error" />
                <h3 class="text-xl font-bold">{{ title }}</h3>
            </div>
            <p class="py-4">{{ description }}</p>
            <div class="modal-action">
                <form method="dialog" class="w-full flex gap-3">
                    <button class="btn btn-sm">Tutup</button>
                    <div class="w-full">
                        <a
                            v-if="type == 'success'"
                            :href="actionLink"
                            target="_blank"
                            class="btn btn-success btn-sm w-full"
                        >
                            Lanjut Pembayaran
                        </a>
                        <button v-else class="btn btn-sm btn-error w-full">
                            Coba Lagi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>
</template>

<script>
import SuccessRibbonIcon from "../icon/successRibbon.vue";
import ErrorIcon from "../icon/error.vue";
export default {
    props: {
        type: "success" | "error",
        title: String,
        description: String,
        actionLink: String,
    },
    components: {
        SuccessRibbonIcon,
        ErrorIcon,
    },
};
</script>

<style></style>
