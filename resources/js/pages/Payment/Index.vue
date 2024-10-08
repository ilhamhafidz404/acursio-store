<script setup>
import { showTransactionAccount } from "../../apis/TransactionAccount";
</script>
<template></template>

<script>
export default {
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
            },
        };
    },
    methods: {
        async fetchShowTransactionAccount() {
            try {
                const result = await showTransactionAccount(
                    this.params.orderId
                );
                if (result) {
                    console.log(result);
                    this.accountStore = result;
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
