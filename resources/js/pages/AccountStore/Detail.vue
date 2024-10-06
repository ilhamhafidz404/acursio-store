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
            <SucessRibbonIcon myClass="size-6" />
            <span>Pembelian Berhasil!</span>
        </div>
        <div class="mt-2">
            <p class="text-sm">
                Berikut adalah email dan password akun-nya:
                <b>{{ purchasedAccount.email }}</b> |
                <b>{{ purchasedAccount.password }}</b>
            </p>
            <p class="text-sm">Atau kamu bisa lihat email untuk detailnya</p>
        </div>
    </div>
    <div class="mt-10 grid md:grid-cols-5 gap-10">
        <div v-if="!isLoading" class="md:col-span-3">
            <div class="flex gap-3 justify-evenly">
                <img
                    :src="
                        'http://127.0.0.1:8000/storage/' + accountStore.image1
                    "
                    alt=""
                    class="rounded"
                />
                <img
                    :src="
                        'http://127.0.0.1:8000/storage/' + accountStore.image2
                    "
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
import axios from "axios";
import Loader from "../../components/loader/index.vue";
import LongArrowLeftIcon from "../../components/icon/longArrowLeft.vue";
import SuccessRibbonIcon from "../../components/icon/successRibbon.vue";

export default {
    components: { Loader, LongArrowLeftIcon, SuccessRibbonIcon },
    data() {
        return {
            id: null,
            isLoading: false,
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
            errorUserData: {
                email: "",
                phone: "",
            },
            isLoadingBuyAccount: false,
            purchasedAccount: {
                email: String,
                password: String,
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
                .post(`http://127.0.0.1:8000/api/buyAccount`, {
                    accountStore: this.accountStore,
                    userData: this.userData,
                })
                .then((res) => {
                    window.open(res.data.payment_url, "_blank");
                    this.purchasedAccount.email = res.data.result.email;
                    this.purchasedAccount.password = res.data.result.password;
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
