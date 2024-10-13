<script setup>
import calculateDiscount from "../../tools/calculateDiscount";
import formatRupiah from "../../tools/formatRupiah";
</script>
<template>
    <div className="card bg-neutral shadow-xl relative overflow-hidden">
        <div
            v-if="account.status == 'sold out' || account.status == 'in order'"
            class="absolute inset-0 bg-black/50 flex items-center justify-center z-10"
        >
            <p
                class="w-full text-center py-3 text-gray-200 font-bold text-xl"
                :class="
                    account.status == 'in order' ? 'bg-warning' : 'bg-error'
                "
            >
                {{
                    account.status == "in order" ? "Dalam Pesanan" : "Sold Out"
                }}
            </p>
        </div>
        <figure>
            <img
                :src="'https://genzedu.id/images/' + account.image1"
                alt="Jubel Akun ML"
                class="w-full h-[300px] object-cover"
            />
        </figure>
        <div className="card-body p-5">
            <router-link :to="'/account-store/' + account.slug">
                <h2 className="card-title">{{ account.title }}</h2>
            </router-link>
            <div class="flex items-end gap-2">
                <del v-if="account.discount" class="text-gray-400 font-bold">
                    {{ formatRupiah(account.price) }}
                </del>
                <p class="text-primary text-xl font-bold">
                    {{
                        formatRupiah(
                            account.discount
                                ? calculateDiscount(
                                      account.price,
                                      account.discount
                                  )
                                : account.price
                        )
                    }}
                </p>
            </div>
        </div>

        <span
            v-if="account.discount"
            class="absolute bg-error text-white top-5 right-[-80px] py-2 px-20 rotate-45 text-xs font-bold"
        >
            Diskon {{ account.discount }}%
        </span>
    </div>
</template>

<script>
export default {
    props: {
        account: Object,
    },
};
</script>

<style></style>
