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
    <div class="border rounded-lg p-5">
        <h1 class="text-2xl text-center mt-4">Mau Dijoki Sampe Mana?</h1>
        <form class="p-3">
            <div>
                <label>Rank Awalmu</label>
                <div class="flex items-center gap-3">
                    <input
                        v-model="formData.begin.star"
                        class="border py-3 px-2 rounded w-[200px]"
                        type="number"
                    />
                    <select
                        v-model="formData.begin.rank"
                        @change="getValue('begin')"
                        class="border py-3 px-2 rounded w-[200px]"
                    >
                        <option hidden>Pilih rank kamu sekarang</option>
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
                <div class="flex items-center gap-3">
                    <input
                        v-model="formData.objective.star"
                        class="border py-3 px-2 rounded w-[200px]"
                        type="number"
                    />
                    <select
                        v-model="formData.objective.rank"
                        @change="getValue('objective')"
                        class="border py-3 px-2 rounded w-[200px]"
                    >
                        <option hidden>Pilih rank Tujuan Kamu</option>
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
            <br /><br />
            <div class="flex gap-3">
                <button
                    class="bg-indigo-500 px-5 py-2 rounded text-white hover:bg-indigo-400"
                >
                    Submit
                </button>
                <button
                    class="bg-red-500 px-5 py-2 rounded text-white hover:bg-red-400"
                    @click.prevent="reset"
                >
                    Reset
                </button>
            </div>
        </form>
        <br />
        <h1 class="text-xl font-bold">{{ total }}</h1>
    </div>
</template>

<!-- // console.log(
    //     (computedData.begin.level * (5 - computedData.begin.star) -
    //         computedData.objective.level *
    //             (5 - computedData.objective.star)) *
    //         6000
    // ); -->
