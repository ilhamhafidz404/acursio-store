<script setup>
import { showTransactionAccount } from "../../apis/TransactionAccount";
</script>
<template>
    <br /><br /><br /><br /><br />
    <Alert
        v-if="alertContent.isShow"
        :type="alertContent.type"
        :message="alertContent.message"
        :description="alertContent.description"
    />
</template>

<script>
import Alert from "../../components/alert/index.vue";
import SuccessRibbonIcon from "../../components/icon/successRibbon.vue";
export default {
    components: { SuccessRibbonIcon, Alert },
    data() {
        return {
            params: {
                orderId: String,
                statusCode: String,
                transactionStatus: String,
            },
            transactionAccount: {
                created_at: String,
                id: Number,
                invoice: String,
                pay: Number,
                selling_account_id: Number,
                status: String,
                updated_at: String,
                user_email: String,
                user_phone: String,
            },
            alertContent: {
                isShow: false,
                type: String,
                message: String,
                description: "",
            },
        };
    },
    methods: {
        setParams() {
            const { order_id, status_code, transaction_status } =
                this.$route.query;

            this.params = {
                orderId: order_id,
                statusCode: status_code,
                transactionStatus: transaction_status,
            };

            const alertMessages = {
                settlement: [
                    "success",
                    "Pembelian Berhasil",
                    "Pembelian akun Mobile Legends Anda telah berhasil. Silakan cek email Anda untuk detail pembelian lebih lanjut.",
                ],
                pending: [
                    "warning",
                    "Pembayaran Tertunda",
                    "Pembelian akun Anda masih dalam proses. Mohon selesaikan pembayaran melalui tautan yang telah dikirimkan ke email Anda.",
                ],
                expire: [
                    "error",
                    "Pembelian Kadaluarsa",
                    "Masa berlaku pembayaran telah berakhir. Silakan lakukan pemesanan ulang jika masih berminat untuk membeli akun.",
                ],
                abandoned: [
                    "error",
                    "Pembelian Dibatalkan",
                    "Pembayaran tidak diselesaikan dan telah dibatalkan. Jika Anda masih ingin membeli akun, silakan buat pesanan baru.",
                ],
            };

            if (alertMessages[transaction_status]) {
                const [type, title, message] =
                    alertMessages[transaction_status];

                this.setAlertContent(true, type, title, message);
            }
        },

        async fetchShowTransactionAccount() {
            try {
                const result = await showTransactionAccount(
                    this.params.orderId
                );

                if (result) {
                    this.transactionAccount = result;
                }
            } catch (error) {
                const errorCode = error.response.data.code;

                if (errorCode == "ACSO-002") {
                    this.setAlertContent(
                        true,
                        "warning",
                        `Tidak ada transaksi dengan kode <b>${this.params.orderId}</b>`
                    );
                } else if (errorCode == "ACSO-003") {
                    this.setAlertContent(true, "error", `Gagal memuat data`);
                }
            } finally {
                this.isLoading = false;
            }
        },
        setAlertContent(isShow, type, message, description = "") {
            this.alertContent = { isShow, type, message, description };
        },
    },
    mounted() {
        this.setParams();
        this.fetchShowTransactionAccount();
    },
};
</script>

<style></style>
