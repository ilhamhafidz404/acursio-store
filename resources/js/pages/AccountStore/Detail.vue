<script setup>
// tools
import calculateDiscount from "../../tools/calculateDiscount";
import formatRank from "../../tools/formatRank";
import formatRupiah from "../../tools/formatRupiah";

// apis
import { getSellingAccountById } from "../../apis/SellingAccount";
</script>
<template>
    <div
        v-if="isLoadingBuyAccount"
        class="fixed inset-0 flex items-center justify-center backdrop-blur-md z-20"
    >
        <Loader text="Proses pembelian akun" />
    </div>

    <div>
        <router-link
            to="/account-store"
            class="btn btn-ghost btn-sm mt-28 inline-flex text-primary"
        >
            <LongArrowLeftIcon myClass="size-6" />

            Kembali
        </router-link>
    </div>
    <div class="mt-10 grid md:grid-cols-5 gap-10">
        <div v-if="!isLoading" class="md:col-span-3">
            <div class="flex gap-3 justify-evenly">
                <img
                    :src="'https://genzedu.id/storage/' + accountStore.image1"
                    alt=""
                    class="rounded w-[400px] h-[300px] object-cover"
                />
                <img
                    v-if="accountStore.image2"
                    :src="'https://genzedu.id/storage/' + accountStore.image2"
                    alt=""
                    class="rounded w-[400px] h-[300px] object-cover"
                />
            </div>
            <div class="mt-5 flex gap-3 flex-end items-center">
                <h1 class="text-3xl font-bold">{{ accountStore.title }}</h1>
                <span
                    v-if="accountStore.discount"
                    class="badge bg-error text-white"
                >
                    Diskon {{ accountStore.discount }}%
                </span>
            </div>
            <div class="flex items-end gap-2">
                <del
                    v-if="accountStore.discount"
                    class="text-gray-400 font-bold"
                >
                    {{ formatRupiah(accountStore.price) }}
                </del>
                <p class="text-primary text-xl font-bold">
                    {{
                        formatRupiah(
                            accountStore.discount
                                ? calculateDiscount(
                                      accountStore.price,
                                      accountStore.discount
                                  )
                                : accountStore.price
                        )
                    }}
                </p>
            </div>
            <div class="mt-5">
                <p class="text-lg">
                    Rank :
                    <span class="font-medium">
                        {{ formatRank(accountStore.rank) }}
                    </span>
                </p>
                <p class="text-lg">
                    Total Hero :
                    <span class="font-medium">
                        {{ accountStore.total_heroes || "-" }}
                    </span>
                </p>
                <p class="text-lg">
                    Total Skin :
                    <span class="font-medium">
                        {{ accountStore.total_skin || "-" }}
                    </span>
                </p>
            </div>
            <p class="mt-5">{{ accountStore.description }}</p>
        </div>
        <div v-else class="md:col-span-3 flex items-center justify-center">
            <Loader text="Loading..." />
        </div>

        <!--  -->

        <div class="md:col-span-2 relative">
            <form
                @submit.prevent="submitBuyAccount"
                method="POST"
                class="sticky top-24 overflow-hidden"
            >
                <div class="bg-neutral p-5 rounded">
                    <div class="flex items-center gap-2">
                        <img
                            src="./../../asset/mobile-legends.webp"
                            alt="Mobile Legends"
                            class="w-[60px] rounded-md"
                        />
                        <h3 class="text-xl font-semibold">Jubel Akun MLBB</h3>
                    </div>

                    <span
                        class="absolute bg-success text-white top-5 right-[-80px] py-2 px-20 rotate-45 text-xs"
                    >
                        100% Aman
                    </span>

                    <hr class="my-5" />

                    <div class="mb-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Masukkan Email</span>
                            </div>
                            <input
                                type="text"
                                class="input input-bordered w-full"
                                :class="{ 'border-error': errorUserData.email }"
                                v-model="userData.email"
                                :disabled="accountStore.status != 'available'"
                            />
                            <div class="label" v-if="errorUserData.email">
                                <span class="label-text text-sm text-error">
                                    {{ errorUserData.email }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="mb-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Masukkan No HP</span>
                            </div>
                            <input
                                type="text"
                                class="input input-bordered w-full"
                                :class="{ 'border-error': errorUserData.phone }"
                                v-model="userData.phone"
                                :disabled="accountStore.status != 'available'"
                            />
                            <div class="label" v-if="errorUserData.phone">
                                <span class="label-text text-sm text-error">
                                    {{ errorUserData.phone }}
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="mb-1 mt-5">
                        <button
                            :type="
                                accountStore.status == 'available'
                                    ? 'submit'
                                    : 'reset'
                            "
                            :class="{
                                'btn btn-primary w-full':
                                    accountStore.status == 'available',
                                'btn btn-warning w-full':
                                    accountStore.status == 'in order',
                                'btn btn-error w-full':
                                    accountStore.status != 'available' &&
                                    accountStore.status != 'in order',
                            }"
                        >
                            {{
                                accountStore.status == "available"
                                    ? "Beli Akun"
                                    : accountStore.status == "in order"
                                    ? "In Order"
                                    : "Sold Out"
                            }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <ConfirmationDialog @postBuyAccount="postBuyAccount" />

    <InformationDialog
        id="informationSuccess"
        icon="success"
        title="Berhasil Melakukan Pemesanan"
        description="Silahkan check email untuk melanjutkan pembayaran anda jika tab baru tidak terbuka!"
        :actionLink="paymentLink"
    />

    <InformationDialog
        id="informationError"
        icon="danger"
        title="Gagal Melakukan Pemesanan"
        description="Silahkan coba pesan lagi untuk mengorder"
    />
</template>

<script>
import axios from "axios";

// components
import Loader from "../../components/loader/index.vue";
import LongArrowLeftIcon from "../../components/icon/longArrowLeft.vue";
import SuccessRibbonIcon from "../../components/icon/successRibbon.vue";
import ConfirmationDialog from "../../components/dialog/confirmationDialog.vue";
import InformationDialog from "../../components/dialog/informationDialog.vue";

export default {
    components: {
        Loader,
        LongArrowLeftIcon,
        SuccessRibbonIcon,
        ConfirmationDialog,
        InformationDialog,
    },
    data() {
        return {
            id: null,
            isLoading: false,
            accountStore: {
                created_at: String,
                description: String,
                discount: 0,
                id: Number,
                image1: String,
                image2: String,
                price: Number,
                rank: "",
                slug: String,
                status: String,
                title: String,
                total_heroes: Number,
                total_skin: Number,
                update_at: String,
            },
            userData: {
                email: "",
                phone: "",
            },
            errorUserData: {
                email: "",
                phone: "",
            },
            isLoadingBuyAccount: false,
            paymentLink: String,
        };
    },
    methods: {
        async fetchSellingAccountById() {
            this.isLoading = true;
            try {
                const result = await getSellingAccountById(this.id);
                if (result) {
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
        submitBuyAccount() {
            const { email, phone } = this.userData;
            const isValidEmail = (email) =>
                /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            const isValidPhone = (phone) =>
                /^(?:\+62|62|0)8[1-9][0-9]{6,11}$/.test(phone);

            this.errorUserData = { email: "", phone: "" };

            if (!email) {
                this.errorUserData.email = "Harap isi email sebelum membeli!";
            } else if (!isValidEmail(email)) {
                this.errorUserData.email = "Masukkan email dengan benar";
            }

            if (!phone) {
                this.errorUserData.phone = "Harap isi no HP sebelum membeli!";
            } else if (!isValidPhone(phone)) {
                this.errorUserData.phone = "Harap isi no HP dengan benar!";
            }

            if (!this.errorUserData.email && !this.errorUserData.phone) {
                confirmationBuy.showModal();
            }
        },
        postBuyAccount() {
            this.isLoadingBuyAccount = true;
            axios
                // .post(`https://genzedu.id/api/buyAccount`, {
                .post(`http://127.0.0.1:8000/api/buyAccount`, {
                    accountStore: this.accountStore,
                    userData: this.userData,
                })
                .then((res) => {
                    this.isLoadingBuyAccount = false;

                    this.paymentLink = res.data.payment_url;
                    window.open(res.data.payment_url, "_blank");

                    informationSuccess.showModal();
                })
                .catch((error) => {
                    informationError.showModal();

                    this.isLoadingBuyAccount = false;
                    console.error(error);
                });

            this.fetchSellingAccountById();
        },
    },
    mounted() {
        this.id = this.$route.params.id;
        this.fetchSellingAccountById();
        window.scrollTo(0, 0);
    },
};
</script>

<style scoped></style>
