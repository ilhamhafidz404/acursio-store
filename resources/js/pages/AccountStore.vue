<template>
    <main class="xl:grid grid-cols-4 gap-5 pt-20">
        <aside class="relative">
            <div
                class="bg-neutral shadow p-5 rounded overflow-hidden sticky top-[100px]"
            >
                <div class="flex items-center gap-2">
                    <img
                        src="./../asset/mobile-legends.webp"
                        alt="Mobile Legends"
                        class="w-[60px] rounded-md"
                    />
                    <h3 class="text-xl font-semibold">Jubel Akun MLBB</h3>
                </div>

                <hr class="my-5" />

                <div>
                    <h3 class="font-medium mb-3 text-gray-100">Filter</h3>
                    <form @submit.prevent="filterSearchParams">
                        <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text"
                                        >Harga Minimal</span
                                    >
                                </div>
                                <!-- <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    v-model="filter.minPrice"
                                /> -->
                                <input
                                    type="text"
                                    class="input input-bordered w-full mb-2"
                                    :value="formatCurrency(filter.minPrice)"
                                    @input="
                                        updatePrice(
                                            $event.target.value,
                                            'minPrice'
                                        )
                                    "
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text"
                                        >Harga Maksimal</span
                                    >
                                </div>
                                <!-- <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    v-model="filter.maxPrice"
                                /> -->
                                <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    :value="formatCurrency(filter.maxPrice)"
                                    @input="
                                        updatePrice(
                                            $event.target.value,
                                            'maxPrice'
                                        )
                                    "
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Jumlah Hero</span>
                                </div>
                                <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    v-model="filter.totalHero"
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Jumlah Skin</span>
                                </div>
                                <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    v-model="filter.totalSkin"
                                />
                            </label>
                        </div>
                        <!-- <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text"
                                        >Winrate Minimal</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    v-model="filter.winrate"
                                />
                            </label>
                        </div> -->
                        <div class="mt-7 flex gap-2">
                            <div v-if="isFilterActive" class="w-full">
                                <button
                                    type="button"
                                    class="btn btn-error w-full"
                                    @click="resetFilter"
                                >
                                    Reset
                                </button>
                            </div>
                            <div class="w-full">
                                <button
                                    type="submit"
                                    class="btn btn-primary w-full"
                                >
                                    Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <div v-if="!isLoading" class="col-span-3 shadow rounded-lg p-5">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
                <Card
                    v-for="account in AccountStores.data"
                    :key="account.id"
                    :account="account"
                />
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-between items-center mb-20">
                <button
                    :disabled="!AccountStores.prev_page_url"
                    @click="fetchSellingAccounts(AccountStores.prev_page_url)"
                    class="btn btn-primary"
                >
                    Previous
                </button>

                <span
                    >Page {{ AccountStores.current_page }} of
                    {{ AccountStores.last_page }}</span
                >

                <button
                    :disabled="!AccountStores.next_page_url"
                    @click="fetchSellingAccounts(AccountStores.next_page_url)"
                    class="btn btn-primary"
                >
                    Next
                </button>
            </div>
        </div>
        <div v-else class="col-span-3 flex justify-center items-center">
            <Loader />
        </div>
    </main>
</template>

<script>
import axios from "axios";
import Card from "./../components/card/index.vue";
import Loader from "./../components/loader/index.vue";
import formatRupiah from "../tools/formatRupiah";

export default {
    components: { Card, Loader },
    data() {
        return {
            isLoading: false,
            AccountStores: {
                data: [],
                current_page: 1,
                last_page: 1,
                prev_page_url: null,
                next_page_url: null,
            },
            filter: {
                minPrice: "",
                maxPrice: "",
                totalHero: "",
                totalSkin: "",
                winrate: "",
            },
            pagination: {
                page: 1,
            },
        };
    },
    methods: {
        formatCurrency(value) {
            return formatRupiah(value);
        },
        updatePrice(value, field) {
            const numericValue = value.replace(/\D/g, "");
            this.filter[field] = numericValue ? parseInt(numericValue) : 0;
        },
        fetchSellingAccounts(
            url = "http://127.0.0.1:8000/api/sellingAccounts"
        ) {
            this.isLoading = true;
            this.$router.push({
                path: "/account-store",
                query: { page: this.pagination.page },
            });

            axios
                .get(url, {
                    params: this.filter,
                })
                .then((res) => {
                    this.AccountStores = res.data.result;

                    this.isLoading = false;
                })
                .catch((error) => {
                    this.isLoading = false;
                    console.error(error);
                });
        },
        resetFilter() {
            this.filter.minPrice = "";
            this.filter.maxPrice = "";
            this.filter.totalHero = "";
            this.filter.totalSkin = "";
            this.filter.winrate = "";
            //
            this.fetchSellingAccounts();
        },
        filterSearchParams() {
            this.fetchSellingAccounts();
        },
    },
    computed: {
        isFilterActive() {
            return (
                this.filter.minPrice ||
                this.filter.maxPrice ||
                this.filter.totalHero ||
                this.filter.totalSkin ||
                this.filter.winrate
            );
        },
    },
    mounted() {
        this.fetchSellingAccounts();
    },
};
</script>
