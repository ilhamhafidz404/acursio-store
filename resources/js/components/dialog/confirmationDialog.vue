<template>
    <dialog id="confirmationBuy" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Konfirmasi Pembelian</h3>
            <p class="py-4">Pastikan Email dan Nomor HP anda sudah benar!</p>
            <div class="modal-action">
                <form method="dialog" class="flex gap-3">
                    <button class="btn">Batal</button>
                    <button class="btn btn-primary" @click="postBuyAccount">
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
