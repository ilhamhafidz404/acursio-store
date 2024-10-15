<template>
    <div>
        <Navbar />
        <div class="px-3 md:px-10 xl:px-20 mb-10 min-h-screen">
            <router-view></router-view>
            <Toast
                v-if="showToast"
                :accountTitle="sellingTransactionAccount.title"
                :dateTime="sellingTransactionAccount.created_at"
                :email="sellingTransactionAccount.email"
            />
        </div>
        <FooterComponent />
    </div>
</template>

<script>
// apis
import { getTransactionAccount } from "./apis/TransactionAccount";

// components
import Navbar from "./components/navbar/index.vue";
import Toast from "./components/toast/index.vue";
import FooterComponent from "./components/footer/index.vue";

export default {
    components: { Navbar, FooterComponent, Toast },
    data() {
        return {
            showToast: false,
            transactionAccounts: [],
            sellingTransactionAccount: {
                created_at: String,
                email: String,
                title: String,
                slug: String,
            },
        };
    },
    methods: {
        async triggerToast() {
            this.showToast = true;
            setTimeout(() => {
                this.showToast = false;
            }, 4000);
        },
        async fetchTransactionAccount() {
            try {
                const result = await getTransactionAccount();

                if (result && Array.isArray(result)) {
                    this.transactionAccounts = result;
                } else {
                    console.error(
                        "Failed to fetch transaction accounts: invalid data format"
                    );
                }
            } catch (error) {
                console.error("Error fetching transaction accounts:", error);
            }
        },
        takeTransactionAccount() {
            // Cek apakah `transactionAccounts` ada dan bukan array kosong
            if (
                !this.transactionAccounts ||
                this.transactionAccounts.length === 0
            ) {
                console.error("No transaction accounts available");
                return;
            }

            // Ambil index acak antara 0 dan transactionAccounts.length - 1
            const arrayIndex = Math.floor(
                Math.random() * this.transactionAccounts.length
            );

            // Ambil account berdasarkan index acak
            const account = this.transactionAccounts[arrayIndex];

            if (account && account.selling_account) {
                // Mengisi data sellingTransactionAccount
                this.sellingTransactionAccount = {
                    ...this.sellingTransactionAccount, // agar data lain tetap ada
                    created_at: account.created_at,
                    email: account.user_email,
                    title: account.selling_account.title,
                    slug: account.selling_account.slug,
                };
            }
        },
    },
    mounted() {
        this.fetchTransactionAccount();

        this.toastInterval = setInterval(() => {
            this.triggerToast();
            this.takeTransactionAccount();
        }, 15000);
    },
    beforeDestroy() {
        clearInterval(this.toastInterval); // Bersihkan interval saat komponen di-destroy
    },
};
</script>
