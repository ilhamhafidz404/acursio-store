<template>
    <dialog id="confirmationBuy" class="modal">
        <div class="modal-box">
            <h3 class="md:text-lg font-bold">Konfirmasi Pembelian</h3>
            <p class="py-4 md:text-base text-sm">
                Pastikan Email dan Nomor HP anda sudah benar!
            </p>
            <div class="modal-action">
                <form method="dialog" class="flex gap-3">
                    <button class="btn md:btn-md btn-sm">Batal</button>
                    <button
                        class="btn btn-primary md:btn-md btn-sm"
                        @click="postBuyAccount"
                    >
                        Lanjut Bayar
                    </button>
                </form>
            </div>
        </div>
    </dialog>
</template>

<script>
export default {
    methods: {
        postBuyAccount() {
            this.$emit("postBuyAccount");
        },
    },
};
</script>

<style></style>
