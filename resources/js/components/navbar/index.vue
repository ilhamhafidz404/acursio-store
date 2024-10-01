<template>
    <nav
        class="px-20 py-3 flex justify-between items-center border-b border-primary fixed left-0 right-0 z-50 bg-neutral"
    >
        <div>
            <img
                src="/resources/js/asset/logo.webp"
                alt="Acursio Logo"
                class="w-[70px]"
            />
        </div>
        <div>
            <ul class="flex items-center- gap-3">
                <li>
                    <router-link
                        exact-active-class="font-medium text-primary"
                        to="/"
                    >
                        Beranda
                    </router-link>
                </li>
                <li>
                    <router-link
                        exact-active-class="font-medium text-primary"
                        to="/jockey-service"
                    >
                        Joki
                    </router-link>
                </li>
                <li>
                    <router-link
                        exact-active-class="font-medium text-primary"
                        to="/account-store"
                    >
                        Jubel
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {};
</script>

<style></style>
