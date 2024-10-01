<script setup>
import formatRupiah from "../../tools/formatRupiah";
</script>
<template>
    <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
        <div class="p-2 flex items-center gap-3">
            <img
                :src="'http://[::1]:5173/resources/js/asset/tier/' + price.img"
                alt=""
                class="w-[40px]"
            />
            <p class="font-medium">{{ price.tier }}</p>
        </div>
        <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
            <p class="text-primary font-semibold">
                {{ formatRupiah(price.price) }}
            </p>
            <span class="text-xs text-gray-300">/ Bintang</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "JockeyPrice",
    props: {
        price: Object,
    },
};
</script>

<style></style>
