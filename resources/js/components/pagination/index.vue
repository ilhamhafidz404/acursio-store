<template>
    <div class="mt-10 flex justify-between items-center mb-20">
        <button
            :disabled="!prevPageUrl"
            @click="inAction(prevPageUrl)"
            class="btn btn-primary"
        >
            Previous
        </button>

        <span>
            Page {{ currentPage }} of
            {{ lastPage }}
        </span>

        <button
            :disabled="!nextPageUrl"
            @click="inAction(nextPageUrl)"
            class="btn btn-primary"
        >
            Next
        </button>
    </div>
</template>

<script>
export default {
    props: {
        prevPageUrl: String,
        nextPageUrl: String,
        currentPage: String,
        lastPage: String,
    },
    methods: {
        inAction(urlFetch) {
            this.$emit("inAction", urlFetch);
        },
    },
};
</script>

<style></style>
