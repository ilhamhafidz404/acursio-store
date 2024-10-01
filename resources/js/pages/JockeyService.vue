<script setup>
import { reactive, computed, watch } from "vue";
import ranks from "./../data/ranks.json";

const formData = reactive({
    begin: { rank: "", star: "" },
    objective: { rank: "", star: "" },
});

const computedData = reactive({
    begin: { rank: "", level: "", star: "" },
    objective: { rank: "", level: "", star: "" },
    total: "",
});

const reset = () => {
    computedData.begin.level = "";
    computedData.begin.rank = "";
    computedData.begin.star = "";
    computedData.objective.level = "";
    computedData.objective.rank = "";
    computedData.objective.star = "";
    computedData.total = "";

    //
    formData.begin.rank = "";
    formData.begin.star = "";
    formData.objective.rank = "";
    formData.objective.star = "";
};

const regex = /(Grand Master|Epic|Legend)\s+(\d+)/;

const getValue = (type) => {
    const matches = formData[type].rank.match(regex);
    if (matches) {
        computedData[type].rank = matches[1];
        computedData[type].level = matches[2];
    }

    computedData[type].star = formData[type].star;

    if (computedData.begin.rank == "Grand Master") {
        if (computedData.objective.rank == "Grand Master") {
            const beginToObjectiveLevel =
                computedData.begin.level - computedData.objective.level;

            if (beginToObjectiveLevel == 0) {
                computedData.total =
                    (computedData.objective.star - computedData.begin.star) *
                    6000;
            } else if (beginToObjectiveLevel == 1) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 2) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 3) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 4) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        5 +
                        computedData.objective.star) *
                    6000;
            }
        }
        if (computedData.objective.rank == "Epic") {
            let beginRank;
            let GMStarPrice;
            if (computedData.begin.level == 5) {
                beginRank = 1;
                GMStarPrice =
                    (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 4) {
                beginRank = 2;
                GMStarPrice =
                    (5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 3) {
                beginRank = 3;
                GMStarPrice = (5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 2) {
                beginRank = 4;
                GMStarPrice = (5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 1) {
                beginRank = 5;
                GMStarPrice = (5 - computedData.begin.star) * 6000;
            }

            let objectiveRank;
            let EpicStarPrice;
            if (computedData.objective.level == 5) {
                objectiveRank = 1;
                EpicStarPrice = computedData.objective.star * 7000;
            } else if (computedData.objective.level == 4) {
                objectiveRank = 2;
                EpicStarPrice = (5 + computedData.objective.star) * 7000;
            } else if (computedData.objective.level == 3) {
                objectiveRank = 3;
                EpicStarPrice = (5 + 5 + computedData.objective.star) * 7000;
            } else if (computedData.objective.level == 2) {
                objectiveRank = 4;
                EpicStarPrice =
                    (5 + 5 + 5 + computedData.objective.star) * 7000;
            } else if (computedData.objective.level == 1) {
                objectiveRank = 5;
                EpicStarPrice =
                    (5 + 5 + 5 + 5 + computedData.objective.star) * 7000;
            }

            computedData.total = GMStarPrice + EpicStarPrice;
        }
        if (computedData.objective.rank == "Legend") {
            let GMStarPrice;
            if (computedData.begin.level == 5) {
                GMStarPrice =
                    (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 4) {
                GMStarPrice =
                    (5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 3) {
                GMStarPrice = (5 + 5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 2) {
                GMStarPrice = (5 + (5 - computedData.begin.star)) * 6000;
            } else if (computedData.begin.level == 1) {
                GMStarPrice = (5 - computedData.begin.star) * 6000;
            }

            let LegendStarPrice;
            if (computedData.objective.level == 5) {
                LegendStarPrice = computedData.objective.star * 8000;
            } else if (computedData.objective.level == 4) {
                LegendStarPrice = (5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 3) {
                LegendStarPrice = (5 + 5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 2) {
                LegendStarPrice =
                    (5 + 5 + 5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 1) {
                LegendStarPrice =
                    (5 + 5 + 5 + 5 + computedData.objective.star) * 8000;
            }

            computedData.total = GMStarPrice + 175000 + LegendStarPrice;
        }
    } else if (computedData.begin.rank == "Epic") {
        if (computedData.objective.rank == "Epic") {
            const beginToObjectiveLevel =
                computedData.begin.level - computedData.objective.level;

            if (beginToObjectiveLevel == 0) {
                computedData.total =
                    (computedData.objective.star - computedData.begin.star) *
                    7000;
            } else if (beginToObjectiveLevel == 1) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                    7000;
            } else if (beginToObjectiveLevel == 2) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                    7000;
            } else if (beginToObjectiveLevel == 3) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                    7000;
            } else if (beginToObjectiveLevel == 4) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        5 +
                        computedData.objective.star) *
                    7000;
            }
        }
        if (computedData.objective.rank == "Legend") {
            let EpicStarPrice;
            if (computedData.begin.level == 5) {
                EpicStarPrice =
                    (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) * 7000;
            } else if (computedData.begin.level == 4) {
                EpicStarPrice =
                    (5 + 5 + 5 + (5 - computedData.begin.star)) * 7000;
            } else if (computedData.begin.level == 3) {
                EpicStarPrice = (5 + 5 + (5 - computedData.begin.star)) * 7000;
            } else if (computedData.begin.level == 2) {
                EpicStarPrice = (5 + (5 - computedData.begin.star)) * 7000;
            } else if (computedData.begin.level == 1) {
                EpicStarPrice = (5 - computedData.begin.star) * 7000;
            }

            let LegendStarPrice;
            if (computedData.objective.level == 5) {
                LegendStarPrice = computedData.objective.star * 8000;
            } else if (computedData.objective.level == 4) {
                LegendStarPrice = (5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 3) {
                LegendStarPrice = (5 + 5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 2) {
                LegendStarPrice =
                    (5 + 5 + 5 + computedData.objective.star) * 8000;
            } else if (computedData.objective.level == 1) {
                LegendStarPrice =
                    (5 + 5 + 5 + 5 + computedData.objective.star) * 8000;
            }

            computedData.total = EpicStarPrice + LegendStarPrice;
        }
    } else if (computedData.begin.rank == "Legend") {
        if (computedData.objective.rank == "Legend") {
            const beginToObjectiveLevel =
                computedData.begin.level - computedData.objective.level;

            if (beginToObjectiveLevel == 0) {
                computedData.total =
                    (computedData.objective.star - computedData.begin.star) *
                    8000;
            } else if (beginToObjectiveLevel == 1) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                    8000;
            } else if (beginToObjectiveLevel == 2) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                    8000;
            } else if (beginToObjectiveLevel == 3) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                    8000;
            } else if (beginToObjectiveLevel == 4) {
                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        5 +
                        computedData.objective.star) *
                    8000;
            }
        }
    }
};

watch(
    () => formData.begin.star,
    (newValue) => {
        if (newValue > 5) {
            formData.begin.star = 5;
        }
    }
);

watch(
    () => formData.objective.star,
    (newValue) => {
        if (newValue > 5) {
            formData.objective.star = 5;
        }
    }
);

const total = computed(() => {
    const formatRupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(number);
    };

    return `Total: ${formatRupiah(computedData.total)}`;
});

const filteredRanks = computed(() => {
    if (computedData.begin.rank && computedData.begin.level) {
        const foundRank = ranks.find(
            (rank) =>
                rank.value ===
                computedData.begin.rank + " " + computedData.begin.level
        );
        return ranks.filter((rank) => {
            return rank.index >= foundRank.index;
        });
    }
});
</script>

<template>
    <!-- <img src="./../asset/background-top.svg" alt="" /> -->
    <main class="grid grid-cols-3 gap-5 pt-20">
        <aside class="bg-neutral shadow p-5 rounded relative overflow-hidden">
            <div class="flex items-center gap-2">
                <img
                    src="./../asset/mobile-legends.webp"
                    alt="Mobile Legends"
                    class="w-[60px] rounded-md"
                />
                <h3 class="text-xl font-semibold">Joki MLBB</h3>
            </div>

            <hr class="my-5" />

            <div>
                <h3 class="font-medium mb-3 text-gray-100">Cara Order Joki</h3>
                <ol class="list-decimal pl-5">
                    <li class="text-sm text-gray-200">Masukkan Email</li>
                    <li class="text-sm text-gray-200">
                        Pilih Produk yang kamu inginkan
                    </li>
                    <li class="text-sm text-gray-200">Selesaikan pembayaran</li>
                    <li class="text-sm text-gray-200">
                        Contact CS melalui whatsapp untuk memberikan detail data
                        login beserta dengan Order ID Cth : P123456789
                    </li>
                </ol>
            </div>

            <div class="grid grid-cols-2 gap-5 mt-10">
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/grandmaster.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Grandmaster</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp 6.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/epic.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Epic</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp 7.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/legend.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Legend</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp 8.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/mythic.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Mythic</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp 10.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/mythical-honor.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Mythical Honor</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp ?.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/mythical-glory.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Mythical Glory</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp ?.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
                <div class="shadow rounded-md overflow-hidden bg-[#1d232a]">
                    <div class="p-2 flex items-center gap-3">
                        <img
                            src="./../asset/tier/mythical-immortal.webp"
                            alt=""
                            class="w-[40px]"
                        />
                        <p class="font-medium">Mythical Immortal</p>
                    </div>
                    <div class="bg-gray-700 py-2 px-2 flex gap-1 items-end">
                        <p class="text-primary font-semibold">Rp 10.000</p>
                        <span class="text-xs text-gray-300">/ Bintang</span>
                    </div>
                </div>
            </div>

            <span
                class="absolute bg-success text-white top-5 right-[-80px] py-2 px-20 rotate-45 text-xs"
                >100% Aman</span
            >
        </aside>
        <div class="bg-neutral col-span-2 shadow rounded-lg p-5">
            <h1 class="text-2xl font-semibold mt-4 uppercase">Order Joki</h1>

            <section class="mt-10">
                <div class="flex items-center gap-3 mb-5">
                    <span
                        class="bg-primary inline-flex w-[30px] h-[30px] text-white text-xl font-semibold items-center justify-center rounded-full"
                        >1</span
                    >
                    <p class="font-medium">Joki dari mana sampe mana?</p>
                </div>
                <form class="p-3">
                    <div>
                        <label>Rank Awalmu</label>
                        <div class="grid grid-cols-2 items-center gap-3">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="size-4 text-warning"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                                <input
                                    class="grow"
                                    placeholder="Bintang Sekarang"
                                    v-model="formData.begin.star"
                                    type="number"
                                />
                            </label>

                            <!-- <input
                                v-model="formData.begin.star"
                                type="number"
                                class="border py-3 px-2 rounded w-[200px]"
                            /> -->
                            <select
                                v-model="formData.begin.rank"
                                @change="getValue('begin')"
                                class="select select-bordered w-full"
                            >
                                <option hidden selected value="">
                                    Tier Sekarang
                                </option>
                                <option
                                    v-for="(rank, index) in ranks"
                                    :key="index"
                                    :value="rank.value"
                                >
                                    {{ rank.placeholder }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div>
                        <label>Rank Tujuanmu</label>
                        <div class="grid grid-cols-2 items-center gap-3">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="size-4 text-warning"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>

                                <input
                                    class="grow"
                                    placeholder="Bintang Tujuan"
                                    v-model="formData.objective.star"
                                    type="number"
                                />
                            </label>
                            <!-- <input
                                v-model="formData.objective.star"
                                class="border py-3 px-2 rounded w-[200px]"
                                type="number"
                            /> -->
                            <select
                                v-model="formData.objective.rank"
                                @change="getValue('objective')"
                                class="select select-bordered w-full"
                            >
                                <option hidden value="">
                                    Pilih rank Tujuan Kamu
                                </option>
                                <option
                                    v-for="(rank, index) in filteredRanks"
                                    :key="index"
                                    :value="rank.value"
                                >
                                    {{ rank.placeholder }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div
                        class="flex justify-evenly bg-[#1d232a] rounded-lg pt-5 pb-20 items-center relative"
                        v-if="computedData.begin.rank"
                    >
                        <div
                            class="flex items-center gap-4"
                            v-if="computedData.begin.rank"
                        >
                            <div>
                                <img
                                    src="./../asset/tier/epic.webp"
                                    class="w-[100px]"
                                />
                            </div>
                            <div>
                                <p class="text-2xl font-medium">EPIC V</p>
                                <p
                                    class="flex items-center text-xl font-medium gap-1"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="size-5 text-warning"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    0
                                </p>
                            </div>
                        </div>
                        <div class="text-center" v-if="computedData.begin.rank">
                            <p class="text-xl font-semibold uppercase mb-2">
                                Joki Ke
                            </p>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="size-6 mx-auto"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                    clip-rule="evenodd"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </div>
                        <div
                            class="flex items-center gap-4"
                            v-if="computedData.objective.rank"
                        >
                            <div>
                                <img
                                    src="./../asset/tier/legend.webp"
                                    class="w-[100px]"
                                />
                            </div>
                            <div>
                                <p class="text-2xl font-medium">Legend I</p>
                                <p
                                    class="flex items-center text-xl font-medium gap-1"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="size-5 text-warning"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    5
                                </p>
                            </div>
                        </div>

                        <div
                            role="alert"
                            class="alert alert-success absolute bottom-0"
                            v-if="
                                computedData.begin.rank &&
                                computedData.objective.rank
                            "
                        >
                            <p class="text-white text-xl font-bold">
                                {{ total }}
                            </p>
                        </div>
                    </div>
                    <br /><br />
                    <!-- <div class="flex gap-3">
                        <button class="btn btn-primary">Submit</button>
                        <button class="btn btn-error" @click.prevent="reset">
                            Reset
                        </button>
                    </div> -->
                </form>
            </section>
            <section>
                <div class="flex items-center gap-3 mb-5">
                    <span
                        class="bg-primary inline-flex w-[30px] h-[30px] text-white text-xl font-semibold items-center justify-center rounded-full"
                        >2</span
                    >
                    <p class="font-medium">Masukkan ID Mobile Legend</p>
                </div>
            </section>
        </div>
    </main>
</template>

<!-- // console.log(
    //     (computedData.begin.level * (5 - computedData.begin.star) -
    //         computedData.objective.level *
    //             (5 - computedData.objective.star)) *
    //         6000
    // ); -->
