<script setup>
import calculateDiscount from "../../tools/calculateDiscount";
import formatRank from "../../tools/formatRank";
import formatRupiah from "../../tools/formatRupiah";
</script>
<template>
    <div class="pt-20 grid grid-cols-5 gap-10">
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
            <loader />
        </div>
        <div class="col-span-2 relative">
            <div class="bg-neutral p-5 rounded sticky top-24 overflow-hidden">
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
                        />
                    </label>
                </div>
                <div class="mb-1 mt-5">
                    <button class="btn btn-primary w-full">Beli Akun</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Loader from "../../components/loader/index.vue";

export default {
    components: { Loader },
    data() {
        return {
            id: null,
            isLoading: false,
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
        };
    },
    methods: {
        fetchSellingAccountById(
            url = `http://127.0.0.1:8000/api/sellingAccounts/${this.id}`
        ) {
            this.isLoading = true;
            // this.$router.push({
            //     path: "/account-store",
            //     query: { page: this.pagination.page },
            // });

            axios
                .get(url)
                .then((res) => {
                    this.accountStore = res.data.data;
                    this.isLoading = false;

                    console.log(this.accountStore);
                })
                .catch((error) => {
                    this.isLoading = false;
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
