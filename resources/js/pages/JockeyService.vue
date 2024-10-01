<script setup></script>

<template>
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
                <JockeyPrice
                    v-for="price in pricing"
                    :key="price.tier"
                    :price="price"
                />
            </div>

            <span
                class="absolute bg-success text-white top-5 right-[-80px] py-2 px-20 rotate-45 text-xs"
            >
                100% Aman
            </span>
        </aside>
        <div class="bg-neutral col-span-2 shadow rounded-lg p-5">
            <h1 class="text-2xl font-semibold mt-4 uppercase">Order Joki</h1>

            <section class="mt-10">
                <div class="flex items-center gap-3 mb-5">
                    <span
                        class="bg-primary inline-flex w-[30px] h-[30px] text-white text-xl font-semibold items-center justify-center rounded-full"
                    >
                        1
                    </span>
                    <p class="font-medium">Joki dari mana sampe mana?</p>
                </div>
                <form class="p-3">
                    <div>
                        <label>Rank Awalmu</label>
                        <div class="grid grid-cols-2 items-center gap-3">
                            <label
                                class="input input-bordered flex items-center gap-2"
                            >
                                <StarIcon myClass="size-4 text-warning" />

                                <input
                                    class="grow"
                                    placeholder="Bintang Sekarang"
                                    v-model="formData.begin.star"
                                    type="number"
                                />
                            </label>

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
                                <StarIcon myClass="size-4 text-warning" />

                                <input
                                    class="grow"
                                    placeholder="Bintang Tujuan"
                                    v-model="formData.objective.star"
                                    type="number"
                                />
                            </label>
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
                                    <StarIcon myClass="size-5 text-warning" />
                                    0
                                </p>
                            </div>
                        </div>
                        <div class="text-center" v-if="computedData.begin.rank">
                            <p class="text-xl font-semibold uppercase mb-2">
                                Joki Ke
                            </p>
                            <DoubleChevronRightIcon myClass="size-6 mx-auto" />
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
                                    <StarIcon myClass="size-5 text-warning" />
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

<script>
import { reactive, computed, watch } from "vue";
import ranks from "./../data/ranks.json";
import pricing from "./../data/jockeyPrice.json";
import JockeyPrice from "../components/card/jockeyPrice.vue";
import StarIcon from "../components/icon/star.vue";
import DoubleChevronRightIcon from "../components/icon/doubleChevronRight.vue";

export default {
    setup() {
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
                            (computedData.objective.star -
                                computedData.begin.star) *
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
                            (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) *
                            6000;
                    } else if (computedData.begin.level == 4) {
                        beginRank = 2;
                        GMStarPrice =
                            (5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
                    } else if (computedData.begin.level == 3) {
                        beginRank = 3;
                        GMStarPrice =
                            (5 + 5 + (5 - computedData.begin.star)) * 6000;
                    } else if (computedData.begin.level == 2) {
                        beginRank = 4;
                        GMStarPrice =
                            (5 + (5 - computedData.begin.star)) * 6000;
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
                        EpicStarPrice =
                            (5 + computedData.objective.star) * 7000;
                    } else if (computedData.objective.level == 3) {
                        objectiveRank = 3;
                        EpicStarPrice =
                            (5 + 5 + computedData.objective.star) * 7000;
                    } else if (computedData.objective.level == 2) {
                        objectiveRank = 4;
                        EpicStarPrice =
                            (5 + 5 + 5 + computedData.objective.star) * 7000;
                    } else if (computedData.objective.level == 1) {
                        objectiveRank = 5;
                        EpicStarPrice =
                            (5 + 5 + 5 + 5 + computedData.objective.star) *
                            7000;
                    }

                    computedData.total = GMStarPrice + EpicStarPrice;
                }
                if (computedData.objective.rank == "Legend") {
                    let GMStarPrice;
                    if (computedData.begin.level == 5) {
                        GMStarPrice =
                            (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) *
                            6000;
                    } else if (computedData.begin.level == 4) {
                        GMStarPrice =
                            (5 + 5 + 5 + (5 - computedData.begin.star)) * 6000;
                    } else if (computedData.begin.level == 3) {
                        GMStarPrice =
                            (5 + 5 + (5 - computedData.begin.star)) * 6000;
                    } else if (computedData.begin.level == 2) {
                        GMStarPrice =
                            (5 + (5 - computedData.begin.star)) * 6000;
                    } else if (computedData.begin.level == 1) {
                        GMStarPrice = (5 - computedData.begin.star) * 6000;
                    }

                    let LegendStarPrice;
                    if (computedData.objective.level == 5) {
                        LegendStarPrice = computedData.objective.star * 8000;
                    } else if (computedData.objective.level == 4) {
                        LegendStarPrice =
                            (5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 3) {
                        LegendStarPrice =
                            (5 + 5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 2) {
                        LegendStarPrice =
                            (5 + 5 + 5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 1) {
                        LegendStarPrice =
                            (5 + 5 + 5 + 5 + computedData.objective.star) *
                            8000;
                    }

                    computedData.total = GMStarPrice + 175000 + LegendStarPrice;
                }
            } else if (computedData.begin.rank == "Epic") {
                if (computedData.objective.rank == "Epic") {
                    const beginToObjectiveLevel =
                        computedData.begin.level - computedData.objective.level;

                    if (beginToObjectiveLevel == 0) {
                        computedData.total =
                            (computedData.objective.star -
                                computedData.begin.star) *
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
                            (5 + 5 + 5 + 5 + (5 - computedData.begin.star)) *
                            7000;
                    } else if (computedData.begin.level == 4) {
                        EpicStarPrice =
                            (5 + 5 + 5 + (5 - computedData.begin.star)) * 7000;
                    } else if (computedData.begin.level == 3) {
                        EpicStarPrice =
                            (5 + 5 + (5 - computedData.begin.star)) * 7000;
                    } else if (computedData.begin.level == 2) {
                        EpicStarPrice =
                            (5 + (5 - computedData.begin.star)) * 7000;
                    } else if (computedData.begin.level == 1) {
                        EpicStarPrice = (5 - computedData.begin.star) * 7000;
                    }

                    let LegendStarPrice;
                    if (computedData.objective.level == 5) {
                        LegendStarPrice = computedData.objective.star * 8000;
                    } else if (computedData.objective.level == 4) {
                        LegendStarPrice =
                            (5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 3) {
                        LegendStarPrice =
                            (5 + 5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 2) {
                        LegendStarPrice =
                            (5 + 5 + 5 + computedData.objective.star) * 8000;
                    } else if (computedData.objective.level == 1) {
                        LegendStarPrice =
                            (5 + 5 + 5 + 5 + computedData.objective.star) *
                            8000;
                    }

                    computedData.total = EpicStarPrice + LegendStarPrice;
                }
            } else if (computedData.begin.rank == "Legend") {
                if (computedData.objective.rank == "Legend") {
                    const beginToObjectiveLevel =
                        computedData.begin.level - computedData.objective.level;

                    if (beginToObjectiveLevel == 0) {
                        computedData.total =
                            (computedData.objective.star -
                                computedData.begin.star) *
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

        return {
            formData,
            computedData,
            reset,
            getValue,
            total,
            filteredRanks,
        };
    },
    components: { JockeyPrice, StarIcon, DoubleChevronRightIcon },
    data() {
        return {
            ranks: ranks,
            pricing: pricing,
        };
    },
    mounted() {
        window.scrollTo(0, 0);
    },
};
</script>
