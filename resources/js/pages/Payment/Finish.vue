<script setup>
import { showTransactionAccount } from "../../apis/TransactionAccount";
</script>
<template>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div
        role="alert"
        class="text-neutral p-5 rounded-md my-10 flex-col"
        :class="{
            'bg-success': params.transactionStatus === 'settlement',
            'bg-warning': params.transactionStatus === 'pending',
        }"
    >
        <div class="flex font-bold gap-2">
            <SuccessRibbonIcon myClass="size-6" />
            <span>Pembelian {{ params.transactionStatus }}!</span>
        </div>
        <div class="mt-2">
            <p class="text-sm">
                PembelianAkun Mobile Legend berhasil, silahkan lihat email
                terkirim di <b>{{ transactionAccount.user_email }}</b>
            </p>
        </div>
    </div>
</template>

<script>
import SuccessRibbonIcon from "../../components/icon/successRibbon.vue";
export default {
    components: { SuccessRibbonIcon },
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
        };
    },
    methods: {
        async fetchShowTransactionAccount() {
            try {
                const result = await showTransactionAccount(
                    this.params.orderId
                );

                console.log(result);

                if (result) {
                    console.log(result);
                    this.transactionAccount = result;
                } else {
                    console.log("No data found");
                }

                this.isLoading = false;
            } catch (error) {
                console.error("Error fetching account:", error);
                this.isLoading = false;
            }
        },
    },
    mounted() {
        this.params.orderId = this.$route.query.order_id;
        this.params.statusCode = this.$route.query.status_code;
        this.params.transactionStatus = this.$route.query.transaction_status;

        this.fetchShowTransactionAccount();
    },
};
</script>

<style></style>
