<script setup>
import formatRupiah from "../../tools/formatRupiah";
</script>
<template>
    <br /><br /><br /><br />

    <DiscountAccountsSection />

    <main class="xl:grid grid-cols-4 gap-5">
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
                        <div class="mb-1">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text"> Hashtag </span>
                                </div>
                                <select
                                    class="select select-bordered w-full"
                                    v-model="filter.hashtag"
                                >
                                    <option
                                        v-if="filter.hashtag"
                                        value=""
                                    ></option>
                                    <option
                                        v-for="hashtag in Hashtags"
                                        :key="hashtag.id"
                                        :value="hashtag.slug"
                                    >
                                        {{ hashtag.title }}
                                    </option>
                                </select>
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
                    <button
                        class="btn btn-primary btn-outline"
                        @click="showModalFilter"
                    >
                        <FilterIcon myClass="size-4" />
                        Filter
                    </button>
                </div>
            </div>
        </aside>

        <div v-if="!isLoading" class="col-span-3 rounded-lg md:p-5">
            <Alert
                v-if="alertContent.isShow"
                :type="alertContent.type"
                :message="alertContent.message"
            />

            <div class="grid grid-cols-2 xl:grid-cols-3 md:gap-5 gap-2">
                <Card
                    v-for="account in AccountStores.data"
                    :key="account.id"
                    :account="account"
                    @handleFilterHastag="filterHashtag"
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
                    <div class="mb-1">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text"> Hashtag </span>
                            </div>
                            <select
                                class="select select-bordered w-full"
                                v-model="filter.hashtag"
                            >
                                <option v-if="filter.hashtag" value=""></option>
                                <option
                                    v-for="hashtag in Hashtags"
                                    :key="hashtag.id"
                                    :value="hashtag.slug"
                                >
                                    {{ hashtag.title }}
                                </option>
                            </select>
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
import { getSellingAccount } from "../../apis/SellingAccount";
import { getHashtags } from "../../apis/Hashtags";

// components
import Card from "../../components/card/index.vue";
import Pagination from "../../components/pagination/index.vue";
import Loader from "../../components/loader/index.vue";
import Alert from "../../components/alert/index.vue";
//
import FilterIcon from "../../components/icon/filter.vue";

// sections
import DiscountAccountsSection from "../../sections/AccountStore/DiscountAccounts.vue";

export default {
    components: {
        Alert,
        Card,
        Loader,
        Pagination,
        //
        FilterIcon,
        //
        DiscountAccountsSection,
    },
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
            isLoadingGetHashtag: false,
            Hashtags: [
                {
                    title: String,
                    slug: String,
                    description: String,
                },
            ],
            filter: {
                minPrice: "",
                maxPrice: "",
                page: 1,
                hashtag: "",
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
        async fetchSellingAccounts(
            page = 1,
            hashtag = "",
            minPrice = "",
            maxPrice = ""
        ) {
            this.isLoading = true;
            this.alertContent.isShow = false;

            this.pagination.page = page;
            this.filter.page = page;

            const query = {};

            if (page) {
                query.page = page;
            }

            if (minPrice) {
                query.minPrice = minPrice;
            }

            if (maxPrice) {
                query.maxPrice = maxPrice;
            }

            if (hashtag) {
                query.hashtag = hashtag;
            }

            // Lakukan push ke router hanya jika query tidak kosong
            if (Object.keys(query).length > 0) {
                this.$router.push({
                    path: "/",
                    query: query,
                });
            }

            window.scrollTo(0, 0);

            try {
                const result = await getSellingAccount(query);

                this.AccountStores = result || {};
            } catch (error) {
                if (error.response.data.code == "ACSO-002") {
                    this.AccountStores = [];
                    this.setAlertContent(true, "warning", "Data Akun Kosong");
                } else {
                    this.setAlertContent(
                        true,
                        "error",
                        "Gagal memuat data, silahkan refresh atau coba kembali"
                    );
                }
                console.error("Error fetching account:", error);
            } finally {
                this.isLoading = false;
            }
        },
        async fetchHashtag() {
            this.isLoadingGetHashtag = true;
            try {
                const result = await getHashtags();

                this.Hashtags = result.data || [];
            } catch (error) {
                this.setAlertContent(
                    true,
                    "error",
                    "Gagal memuat data hashtag, silahkan refresh atau coba kembali"
                );
                console.error("Error fetching account:", error);
            } finally {
                this.isLoadingGetHashtag = false;
            }
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
            this.fetchSellingAccounts(1);
        },
        filterSearchParams() {
            this.fetchSellingAccounts(
                this.filter.page,
                this.filter.hashtag,
                this.filter.minPrice,
                this.filter.maxPrice
            );
        },
        filterHashtag(slug) {
            this.filter.hashtag = slug;
            this.fetchSellingAccounts(1, slug);
        },
        showModalFilter() {
            filterModal.showModal();
        },
    },
    computed: {
        isFilterActive() {
            // Buat salinan dari filter tanpa properti "page"
            const { page, ...restFilters } = this.filter;

            // Cek apakah ada filter yang aktif selain "page"
            return Object.values(restFilters).some((value) => value);
        },
    },

    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get("page");
        const hashtag = urlParams.get("hashtag");
        const minPrice = urlParams.get("minPrice");
        const maxPrice = urlParams.get("maxPrice");

        this.filter = {
            page: page,
            hashtag: hashtag,
            minPrice: minPrice,
            maxPrice: maxPrice,
        };

        this.fetchSellingAccounts(page, hashtag, minPrice, maxPrice);
        this.fetchHashtag();
        window.scrollTo(0, 0);
    },
};
</script>
