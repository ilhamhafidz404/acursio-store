<script setup>
import Card from "./../components/card/index.vue";
</script>
<template>
    <!-- <img src="./../asset/background-top.svg" alt="" /> -->
    <main class="grid grid-cols-4 gap-5 pt-20">
        <aside class="relative">
            <div
                class="bg-neutral shadow p-5 rounded overflow-hidden sticky top-[15px]"
            >
                <div class="flex items-center gap-2">
                    <img
                        src="./../asset/mobile-legends.webp"
                        alt="Mobile Legends"
                        class="w-[60px] rounded-md"
                    />
                    <h3 class="text-xl font-semibold">Jubel Akun MLBB</h3>
                </div>

                <hr class="my-5" />

                <div>
                    <h3 class="font-medium mb-3 text-gray-100">Filter</h3>
                    <form action="">
                        <div class="mb-1">
                            <label className="form-control w-full">
                                <div className="label">
                                    <span className="label-text"
                                        >Harga Minimal</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    placeholder="Rp 100.000"
                                    className="input input-bordered w-full"
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label className="form-control w-full">
                                <div className="label">
                                    <span className="label-text"
                                        >Harga Maksimal</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    placeholder="Rp 100.000.000"
                                    className="input input-bordered w-full"
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label className="form-control w-full">
                                <div className="label">
                                    <span className="label-text"
                                        >Jumlah Hero</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    placeholder="23"
                                    className="input input-bordered w-full"
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label className="form-control w-full">
                                <div className="label">
                                    <span className="label-text"
                                        >Jumlah Skin</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    placeholder="67"
                                    className="input input-bordered w-full"
                                />
                            </label>
                        </div>
                        <div class="mb-1">
                            <label className="form-control w-full">
                                <div className="label">
                                    <span className="label-text"
                                        >Winrate Minimal</span
                                    >
                                </div>
                                <input
                                    type="text"
                                    placeholder="70%"
                                    className="input input-bordered w-full"
                                />
                            </label>
                        </div>
                        <div class="mt-7">
                            <button class="btn btn-primary w-full">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>

                <span
                    class="absolute bg-success text-white top-5 right-[-80px] py-2 px-20 rotate-45 text-xs"
                    >100% Aman</span
                >
            </div>
        </aside>
        <div class="col-span-3 shadow rounded-lg p-5 grid grid-cols-3 gap-5">
            <Card />
            <Card />
            <Card />
            <Card />
        </div>
    </main>
</template>
