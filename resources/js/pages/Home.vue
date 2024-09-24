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

const regex = /(Grand Master|Epic|Legends)\s+(\d+)/;

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
                console.log("1 level");
                console.log(
                    (computedData.objective.star - computedData.begin.star) *
                        6000
                );

                computedData.total =
                    (computedData.objective.star - computedData.begin.star) *
                    6000;
            } else if (beginToObjectiveLevel == 1) {
                console.log("2 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 2) {
                console.log("3 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 3) {
                console.log("4 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 4) {
                console.log("5 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        5 +
                        computedData.objective.star) *
                        6000
                );

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
            const beginToObjectiveLevel =
                computedData.begin.level - computedData.objective.level;

            if (beginToObjectiveLevel == 0) {
                console.log("1 level");
                console.log(
                    (computedData.objective.star - computedData.begin.star) *
                        6000
                );

                computedData.total =
                    (computedData.objective.star - computedData.begin.star) *
                    6000;
            } else if (beginToObjectiveLevel == 1) {
                console.log("2 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 2) {
                console.log("3 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 3) {
                console.log("4 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                        6000
                );

                computedData.total =
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        computedData.objective.star) *
                    6000;
            } else if (beginToObjectiveLevel == 4) {
                console.log("5 level");
                console.log(
                    (5 -
                        computedData.begin.star +
                        5 +
                        5 +
                        5 +
                        computedData.objective.star) *
                        6000
                );

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

const total = computed(() => `Total : ${computedData.total}`);
</script>

<template>
    <div class="border rounded-lg">
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
                            v-for="(rank, index) in ranks"
                            :key="index"
                            :value="rank.value"
                        >
                            {{ rank.placeholder }}
                        </option>
                    </select>
                </div>
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
