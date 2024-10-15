<template>
    <div
        class="fixed md:left-7 md:bottom-7 md:right-auto left-2 bottom-2 right-2 flex gap-4 shadow-sm shadow-primary bg-neutral py-2 pl-2 pr-10 items-center rounded-md z-50"
    >
        <div
            class="bg-primary flex items-center justify-center md:w-[80px] md:h-[80px] w-[50px] h-[50px] rounded"
        >
            <BellIcon myClass="size-7 text-white" />
        </div>
        <div>
            <h2
                class="text-primary md:font-bold font-semibold md:text-base text-sm md:mb-1"
            >
                {{ splitEmail }}
            </h2>
            <p class="md:text-sm text-xs">
                Baru saja membeli akun <b>{{ accountTitle }}</b>
            </p>
            <p class="md:text-sm text-xs">{{ formattedDateTime }}</p>
        </div>
        <!-- Tombol untuk menutup toast -->
        <!-- <button class="absolute top-2 right-2" @click="closeToast">
            <CloseIcon myClass="size-5" />
        </button> -->
    </div>
</template>

<script>
import BellIcon from "../icon/bell.vue";
import CloseIcon from "../icon/close.vue";

export default {
    components: { BellIcon, CloseIcon },
    props: { accountTitle: String, dateTime: String, email: String },
    computed: {
        formattedDateTime() {
            // Format datetime ke dalam bentuk 15/10/2024 05:05
            const date = new Date(this.dateTime);
            const formattedDate =
                date.getDate().toString().padStart(2, "0") +
                "/" +
                (date.getMonth() + 1).toString().padStart(2, "0") +
                "/" +
                date.getFullYear();
            const formattedTime =
                date.getHours().toString().padStart(2, "0") +
                ":" +
                date.getMinutes().toString().padStart(2, "0");
            return `${formattedDate} ${formattedTime}`;
        },
        splitEmail() {
            return this.$props.email.split("@")[0];
        },
    },
    // methods: {
    //     closeToast() {
    //         this.$emit("close-toast");
    //     },
    // },
};
</script>

<style scoped></style>
