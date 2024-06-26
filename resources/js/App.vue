<template>
    <Header
        class="flex-grow-0"
        style="z-index: 2"
        @locale-changed="changeLocale"
    />
    <div
        class="w-100 position-relative manual-height"
        id="main-container"
        :class="{ 'has-cover': $route.path === '/' }"
    >
        <div class="bg-black w-100 h-100 opacity-25"></div>
        <div class="position-absolute top-0 start-0 w-100 h-100">
            <br />
            <div
                class="container"
                style="z-index: 3"
                :class="{
                    'bg-white rounded pt-2': filterRoutes(),
                }"
            >
                <router-view v-slot="{ Component, route }">
                    <transition :name="route.meta.transition || 'fade'">
                        <component :is="Component" :key="route.path" />
                    </transition>
                </router-view>
            </div>
        </div>
        <div
            class="position-absolute bottom-0 start-0 w-100 d-flex flex-column gap-2 p-4"
            v-if="$route.path === '/'"
        >
            <a
                id="email"
                class="title text-white"
                style="text-decoration: none"
                :href="`mailto:${email}`"
                >&#128231; {{ email }}</a
            >
            <a
                id="phone"
                class="title text-white"
                style="text-decoration: none"
                :href="`tel:${phone}`"
                >&#128222; {{ formatPhone() }}</a
            >
        </div>
    </div>
</template>

<script>
import Header from "./components/Header.vue";
import common from "@/mixins/common";

export default {
    name: "App",
    mixins: [common],
    components: {
        Header,
    },
    data() {
        return {
            email: import.meta.env.VITE_COMPANY_EMAIL,
            phone: import.meta.env.VITE_COMPANY_PHONE,
            backgroundPath: import.meta.env.VITE_BACKGROUND_PATH,
        };
    },
    created() {
        this.fetchUser();
    },
    mounted() {
        this.setBackground();
    },
    methods: {
        filterRoutes() {
            return !(
                ["/login", "/"].includes(this.$route.path) ||
                this.$route.path.includes("/edit") ||
                this.$route.path.includes("/create")
            );
        },
        formatPhone() {
            return this.phone
                .replace(/\D+/g, "")
                .replace(
                    /(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/,
                    "+$1 ($2) $3-$4-$5"
                );
        },
        setBackground() {
            if (this.$route.path === "/") {
                document.getElementById(
                    "main-container"
                ).style.backgroundImage = `url('${this.backgroundPath}')`;
            }
        },
    },
};
</script>

<style scoped>
.fade-enter-active {
    transition: all 0.15s ease-out 0.15s;
}
.fade-leave-active {
    transition: all 0.15s ease-in 0s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    margin-top: 100px;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
    margin-top: 0px;
}
.has-cover {
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
}
.manual-height {
    height: calc(100% - 56px);
}
</style>
