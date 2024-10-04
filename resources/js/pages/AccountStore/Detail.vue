<script setup>
import calculateDiscount from "../../tools/calculateDiscount";
import formatRank from "../../tools/formatRank";
import formatRupiah from "../../tools/formatRupiah";
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
    <div
        v-if="showAlertSuccess"
        role="alert"
        className="bg-success text-neutral p-5 rounded-md my-10 flex-col"
    >
        <div class="flex font-bold gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="size-6"
            >
                <path
                    fill-rule="evenodd"
                    d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                    clip-rule="evenodd"
                />
            </svg>

            <span>Pembelian Berhasil!</span>
        </div>
        <div class="mt-2">
            <p class="text-sm">
                Berikut adalah email dan password akun-nya:
                <b>xxspanzie@gmail.com</b> | <b>Password</b>
            </p>
            <p class="text-sm">Atau kamu bisa lihat email untuk detailnya</p>
        </div>
    </div>
    <div class="mt-10 grid grid-cols-5 gap-10">
        <div v-if="!isLoading" class="col-span-3">
            <div class="flex gap-3 justify-evenly">
                <img
                    :src="'http://127.0.0.1:8000/storage/' + accountStore.image"
                    alt=""
                    class="rounded"
                />
                <img
                    :src="'http://127.0.0.1:8000/storage/' + accountStore.image"
                    alt=""
                    class="rounded"
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
                    <span class="font-medium">{{
                        accountStore.total_heroes || "-"
                    }}</span>
                </p>
                <p class="text-lg">
                    Total Skin :
                    <span class="font-medium">{{
                        accountStore.total_skin || "-"
                    }}</span>
                </p>
            </div>
            <p class="mt-5">{{ accountStore.description }}</p>
        </div>
        <div v-else class="col-span-3 flex items-center justify-center">
            <Loader text="Loading..." />
        </div>

        <!--  -->

        <div class="col-span-2 relative">
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
                                v-model="userData.email"
                            />
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
                                v-model="userData.phone"
                            />
                        </label>
                    </div>
                    <div class="mb-1 mt-5">
                        <button
                            v-if="accountStore.status == 'available'"
                            type="submit"
                            class="btn btn-primary w-full"
                        >
                            Beli Akun
                        </button>
                        <button
                            v-else
                            type="reset"
                            class="btn btn-error w-full"
                        >
                            Sold Out
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Loader from "../../components/loader/index.vue";
import LongArrowLeftIcon from "../../components/icon/longArrowLeft.vue";

export default {
    components: { Loader, LongArrowLeftIcon },
    data() {
        return {
            id: null,
            isLoading: false,
            isLoadingBuyAccount: false,
            showAlertSuccess: false,
            accountStore: {
                created_at: String,
                description: String,
                discount: 0,
                id: Number,
                image: String,
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
        };
    },
    methods: {
        fetchSellingAccountById(
            url = `http://127.0.0.1:8000/api/sellingAccounts/${this.id}`
        ) {
            this.isLoading = true;

            axios
                .get(url)
                .then((res) => {
                    this.accountStore = res.data.result;
                    this.isLoading = false;

                    console.log(this.accountStore);
                })
                .catch((error) => {
                    this.isLoading = false;
                    console.error(error);
                });
        },
        submitBuyAccount() {
            this.isLoadingBuyAccount = true;
            axios
                .post(`http://127.0.0.1:8000/api/buyAccount`, {
                    accountStore: this.accountStore,
                    userData: this.userData,
                })
                .then((res) => {
                    console.log(res);
                    this.isLoadingBuyAccount = false;
                    this.showAlertSuccess = true;
                })
                .catch((error) => {
                    this.isLoadingBuyAccount = false;
                    console.error(error);
                });
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
