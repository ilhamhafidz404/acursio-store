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
                                    <span class="label-text">
                                        Kategori Skin
                                    </span>
                                </div>
                                <select
                                    class="select select-bordered w-full"
                                    v-model="filter.skinCategory"
                                >
                                    <option
                                        v-if="filter.skinCategory"
                                        value=""
                                    ></option>
                                    <option
                                        v-for="category in SkinCategories"
                                        :key="category.id"
                                        :value="category.slug"
                                    >
                                        {{ category.title }}
                                    </option>
                                </select>
                            </label>
                        </div>
                        <div class="mb-1" v-if="filter.skinCategory">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text"> Skin </span>
                                </div>
                                <select
                                    class="select select-bordered w-full"
                                    v-model="filter.skin"
                                >
                                    <option
                                        v-if="filteredSkin"
                                        value=""
                                    ></option>
                                    <option
                                        v-for="skin in filteredSkin"
                                        :key="skin.id"
                                        :value="skin.slug"
                                    >
                                        {{ skin.title }}
                                    </option>
                                </select>
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <label class="label cursor-pointer">
                                <span class="label-text">Full Emblem?</span>
                                <input
                                    type="checkbox"
                                    class="toggle"
                                    checked="checked"
                                    v-model="filter.isFullEmblem"
                                />
                            </label>
                        </div>
                        <div class="mb-1 mt-3">
                            <label class="label cursor-pointer">
                                <span class="label-text">Full Hero?</span>
                                <input
                                    type="checkbox"
                                    class="toggle"
                                    checked="checked"
                                    v-model="filter.isFullHero"
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
                    @handleFilterSkin="filterSkin"
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
                                <span class="label-text"> Kategori Skin </span>
                            </div>
                            <select
                                class="select select-bordered w-full"
                                v-model="filter.skinCategory"
                            >
                                <option
                                    v-if="filter.skinCategory"
                                    value=""
                                ></option>
                                <option
                                    v-for="category in SkinCategories"
                                    :key="category.id"
                                    :value="category.slug"
                                >
                                    {{ category.title }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="mb-1" v-if="filter.skinCategory">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text"> Skin </span>
                            </div>
                            <select
                                class="select select-bordered w-full"
                                v-model="filter.skin"
                            >
                                <option v-if="filteredSkin" value=""></option>
                                <option
                                    v-for="skin in filteredSkin"
                                    :key="skin.id"
                                    :value="skin.slug"
                                >
                                    {{ skin.title }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class="mb-1 mt-3">
                        <label class="label cursor-pointer">
                            <span class="label-text">Full Emblem?</span>
                            <input
                                type="checkbox"
                                class="toggle"
                                checked="checked"
                                v-model="filter.isFullEmblem"
                            />
                        </label>
                    </div>
                    <div class="mb-1 mt-3">
                        <label class="label cursor-pointer">
                            <span class="label-text">Full Hero?</span>
                            <input
                                type="checkbox"
                                class="toggle"
                                checked="checked"
                                v-model="filter.isFullHero"
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
import { getSellingAccount } from "../../apis/SellingAccount";
import { getSkins } from "../../apis/Skin";
import { getSkinCategories } from "../../apis/SkinCategory";

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
            isLoadingGetSkins: false,
            Skins: [
                {
                    title: String,
                    slug: String,
                    description: String,
                },
            ],
            isLoadingGetSkinCategories: false,
            SkinCategories: [
                {
                    title: String,
                    slug: String,
                },
            ],
            filter: {
                minPrice: "",
                maxPrice: "",
                page: 1,
                skinCategory: "",
                skin: "",
                isFullEmblem: false,
                isFullHero: false,
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
            skinCategory = "",
            skin = "",
            minPrice = "",
            maxPrice = "",
            isFullEmblem = false,
            isFullHero = false
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

            if (skinCategory) {
                query.skinCategory = skinCategory;
            }

            if (skin) {
                query.skin = skin;
            }

            if (isFullEmblem) {
                query.isFullEmblem = true;
            }

            if (isFullHero) {
                query.isFullHero = true;
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
            this.isLoadingGetSkins = true;
            try {
                const result = await getSkins();

                this.Skins = result.data || [];
            } catch (error) {
                this.setAlertContent(
                    true,
                    "error",
                    "Gagal memuat data hashtag, silahkan refresh atau coba kembali"
                );
                console.error("Error fetching account:", error);
            } finally {
                this.isLoadingGetSkins = false;
            }
        },
        async fetchSkinCategory() {
            this.isLoadingGetSkinCategories = true;
            try {
                const result = await getSkinCategories();

                this.SkinCategories = result.data || [];
            } catch (error) {
                this.setAlertContent(
                    true,
                    "error",
                    "Gagal memuat data kategori skin, silahkan refresh atau coba kembali"
                );
                console.error("Error fetching account:", error);
            } finally {
                this.isLoadingGetSkinCategories = false;
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
                this.filter.skinCategory,
                this.filter.skin,
                this.filter.minPrice,
                this.filter.maxPrice,
                this.filter.isFullEmblem,
                this.filter.isFullHero
            );
        },
        filterSkin(slug) {
            this.filter.skin = slug;
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
        filteredSkin() {
            return this.Skins.filter(
                (skin) => skin.skin_category.slug === this.filter.skinCategory
            );
        },
    },

    mounted() {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get("page");
        const skinCategory = urlParams.get("skinCategory");
        const skin = urlParams.get("skin");
        const minPrice = urlParams.get("minPrice");
        const maxPrice = urlParams.get("maxPrice");

        this.filter = {
            page: page,
            minPrice: minPrice,
            maxPrice: maxPrice,
            skinCategory: skinCategory,
            skin: skin,
        };

        this.fetchSellingAccounts(page, skinCategory, skin, minPrice, maxPrice);
        this.fetchSkinCategory();
        this.fetchHashtag();
        window.scrollTo(0, 0);
    },
};
</script>
