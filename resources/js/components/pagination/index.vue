<template>
    <div class="mt-10 flex justify-center items-center mb-20">
        <!-- Previous button -->
        <button
            :disabled="!prevPageUrl"
            @click="inAction(prevPageUrl)"
            class="btn btn-primary md:btn-md btn-sm md:px-auto px-2"
        >
            <span class="md:block hidden"> Previous </span>
            <ChevronLeftIcon myClass="size-4 md:hidden block" />
        </button>

        <!-- Page numbers -->
        <button
            v-for="page in pages"
            :key="page"
            @click="inAction(page)"
            class="btn mx-[2px] md:btn-md btn-sm"
            :class="{
                'btn-outline btn-primary': page === currentPage,
                'btn-default': page !== currentPage,
            }"
        >
            {{ page }}
        </button>

        <!-- Next button -->
        <button
            :disabled="!nextPageUrl"
            @click="inAction(nextPageUrl)"
            class="btn btn-primary md:btn-md btn-sm md:px-auto px-2"
        >
            <span class="md:block hidden"> Next </span>
            <ChevronRightIcon myClass="size-4 md:hidden block" />
        </button>
    </div>
</template>

<script>
import ChevronRightIcon from "../icon/chevronRight.vue";
import ChevronLeftIcon from "../icon/chevronLeft.vue";
export default {
    components: {
        ChevronLeftIcon,
        ChevronRightIcon,
    },
    props: {
        prevPageUrl: String,
        nextPageUrl: String,
        currentPage: String,
        lastPage: String,
    },
    computed: {
        pages() {
            const range = [];
            const rangeWithDots = [];
            const total = this.lastPage;
            const delta = 1; // Berapa banyak halaman yang ingin ditampilkan sebelum/sesudah halaman saat ini

            let left = this.currentPage - delta;
            let right = this.currentPage + delta + 1;
            let l;

            // Membatasi nilai left dan right agar tidak keluar dari batas total halaman
            if (left < 1) left = 1;
            if (right > total) right = total + 1;

            // Tentukan halaman yang harus selalu ada (1 dan total)
            for (let i = 1; i <= total; i++) {
                if (i === 1 || i === total || (i >= left && i < right)) {
                    range.push(i);
                }
            }

            // Tambahkan titik-titik ketika ada jarak lebih dari 1 halaman
            for (const i of range) {
                if (l) {
                    if (i - l === 2) {
                        rangeWithDots.push(l + 1); // Menambahkan halaman yang terlewat satu
                    } else if (i - l > 2) {
                        rangeWithDots.push("..."); // Tambahkan titik-titik untuk jarak lebih dari 2 halaman
                    }
                }
                rangeWithDots.push(i);
                l = i;
            }

            return rangeWithDots;
        },
    },
    methods: {
        inAction(page) {
            if (page !== "...") {
                const urlParams = new URLSearchParams(window.location.search);
                const hashtag = urlParams.get("hashtag");
                const minPrice = urlParams.get("minPrice");
                const maxPrice = urlParams.get("maxPrice");

                if (typeof page == "string") {
                    const regex = /[?&]page=(\d+)/;

                    const match = page.match(regex);

                    const pageParam = match ? match[1] : 1;

                    this.$emit(
                        "inAction",
                        pageParam,
                        hashtag,
                        minPrice,
                        maxPrice
                    );
                } else if (typeof page == "number") {
                    this.$emit("inAction", page, hashtag, minPrice, maxPrice);
                }
            }
        },
    },
};
</script>
