<template>
    <section v-if="hasDiscountMoreThan3">
        <div class="flex items-center justify-between mb-10 mt-5">
            <div class="flex items-center md:gap-4 gap-2">
                <img
                    src="/resources/js/asset/mobile-legends.webp"
                    alt="Mobile Legends"
                    class="md:w-[70px] w-[40px] rounded-md"
                />
                <h3 class="font-semibold md:text-xl">Akun Diskon</h3>
            </div>
            <div>
                <button
                    class="btn btn-success md:btn-md btn-sm md:text-base text-xs"
                >
                    100% Aman
                </button>
            </div>
        </div>

        <Slider :AccountStores="AccountStores" />

        <hr class="my-10 border-[#2a323c]" />
    </section>
</template>

<script>
import { getSellingAccount } from "../../apis/SellingAccount";
import Slider from "../../components/slider/index.vue";
export default {
    components: { Slider },
    data: () => ({
        AccountStores: {
            data: [],
            current_page: 1,
            last_page: 1,
            prev_page_url: null,
            next_page_url: null,
        },
        hasDiscountMoreThan3: false,
        isLoading: false,
    }),
    methods: {
        async fetchSellingAccounts() {
            try {
                const result = await getSellingAccount({
                    condition: 2,
                });

                this.AccountStores = result || {};

                if (this.AccountStores.data.length >= 3) {
                    this.hasDiscountMoreThan3 = true;
                }
            } catch (error) {
                this.hasDiscountMoreThan3 = false;
                console.error("Error fetching discount account:", error);
            }
        },
    },
    mounted() {
        this.fetchSellingAccounts();
    },
};
</script>
