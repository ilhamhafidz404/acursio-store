<script setup>
import formatRupiah from "../../tools/formatRupiah";
</script>
<template>
    <main class="xl:grid grid-cols-4 gap-5 pt-20">
        <aside class="relative">
            <div
                class="bg-neutral shadow p-5 rounded overflow-hidden sticky top-[100px] md:block hidden"
            >
                <div class="flex items-center gap-2">
                    <img
                        src="/resources/js/asset/mobile-legends.webp"
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
                                    <span class="label-text">
                                        Harga Minimal
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="input input-bordered w-full mb-2"
                                    :value="formatRupiah(filter.minPrice)"
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
                                    <span class="label-text">
                                        Harga Maksimal
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    class="input input-bordered w-full"
                                    :value="formatRupiah(filter.maxPrice)"
                                    @input="
                                        updatePrice(
                                            $event.target.value,
                                            'maxPrice'
                                        )
                                    "
                                />
                            </label>
                        </div>
                        <!-- <div class="mb-1">
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

            <div class="flex md:hidden items-center justify-between mb-10 mt-5">
                <div class="flex items-center gap-2">
                    <img
                        src="/resources/js/asset/mobile-legends.webp"
                        alt="Mobile Legends"
                        class="w-[40px] rounded-md"
                    />
                    <h3 class="font-semibold">Jubel Akun MLBB</h3>
                </div>
                <div>
                    <button class="btn btn-neutral" @click="showModalFilter">
                        Filter
                    </button>
                </div>
            </div>
        </aside>

        <div v-if="!isLoading" class="col-span-3 rounded-lg p-5">
            <Alert
                v-if="alertContent.isShow"
                :type="alertContent.type"
                :message="alertContent.message"
            />

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
                <Card
                    v-for="account in AccountStores.data"
                    :key="account.id"
                    :account="account"
                />
            </div>

            <Pagination
                :prevPageUrl="AccountStores.prev_page_url"
                :nextPageUrl="AccountStores.next_page_url"
                :currentPage="AccountStores.current_page"
                :lastPage="AccountStores.last_page"
                @inAction="fetchSellingAccounts"
            />
        </div>
        <div v-else class="col-span-3 flex justify-center items-center">
            <Loader text="Loading..." />
        </div>

        <dialog class="modal" id="filterModal">
            <div class="modal-box">
                <h3 class="text-lg font-bold mb-5">Filter!</h3>
                <form @submit.prevent="filterSearchParams">
                    <div class="mb-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text"> Harga Minimal </span>
                            </div>
                            <input
                                type="text"
                                class="input input-bordered w-full mb-2"
                                :value="formatRupiah(filter.minPrice)"
                                @input="
                                    updatePrice($event.target.value, 'minPrice')
                                "
                            />
                        </label>
                    </div>
                    <div class="mb-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text"> Harga Maksimal </span>
                            </div>
                            <input
                                type="text"
                                class="input input-bordered w-full"
                                :value="formatRupiah(filter.maxPrice)"
                                @input="
                                    updatePrice($event.target.value, 'maxPrice')
                                "
                            />
                        </label>
                    </div>
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
                <form method="dialog">
                    <button class="btn mt-2 w-full">Close</button>
                </form>
            </div>
        </dialog>
    </main>
</template>

<script>
import axios from "axios";

// components
import Card from "../../components/card/index.vue";
import Pagination from "../../components/pagination/index.vue";
import Loader from "../../components/loader/index.vue";
import Alert from "../../components/alert/index.vue";

export default {
    components: { Alert, Card, Loader, Pagination },
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
            alertContent: {
                isShow: false,
                type: String,
                message: String,
            },
        };
    },
    methods: {
        updatePrice(value, field) {
            const numericValue = value.replace(/\D/g, "");
            this.filter[field] = numericValue ? parseInt(numericValue) : 0;
        },
        // fetchSellingAccounts(url = `https://genzedu.id/api/sellingAccounts/`) {
        fetchSellingAccounts(
            url = `http://127.0.0.1:8000/api/sellingAccounts/`
        ) {
            this.isLoading = true;
            this.alertContent.isShow = false;

            // this.$router.push({
            //     path: "/account-store",
            //     query: { page: this.pagination.page },
            // });
            this.$router.push({
                path: "/",
                query: { page: this.pagination.page },
            });

            axios
                .get(url, {
                    params: this.filter,
                })
                .then((res) => {
                    this.AccountStores = res.data.result;

                    if (!this.AccountStores.data.length) {
                        this.setAlertContent(
                            true,
                            "warning",
                            `Data Akun Kosong`
                        );
                    }
                })
                .catch((error) => {
                    this.setAlertContent(
                        true,
                        "error",
                        `Gagal Memuat Data, Silahkan Coba Lagi`
                    );

                    console.error(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        setAlertContent(isShow, type, message) {
            this.alertContent = { isShow, type, message };
        },
        resetFilter() {
            this.filter = {
                minPrice: "",
                maxPrice: "",
                totalHero: "",
                totalSkin: "",
                winrate: "",
            };
            //
            this.fetchSellingAccounts();
        },
        filterSearchParams() {
            this.fetchSellingAccounts();
        },
        showModalFilter() {
            filterModal.showModal();
        },
    },
    computed: {
        isFilterActive() {
            return Object.values(this.filter).some((value) => value);
        },
    },

    mounted() {
        this.fetchSellingAccounts();
        window.scrollTo(0, 0);
    },
};
</script>
