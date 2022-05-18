<template>
    <div class="bg-white py-2 shadow-lg z-50 antialiased sticky top-0 w-full">
        <div class="flex justify-between items-center relative">
            <div class="flex items-center ml-6">
                <span class="shrink-0 shadow-md"
                    ><img
                        class="image fill-red-500"
                        src="../../assets/eaglewealthlogo.jfif"
                        alt="eagle wealth logo"
                /></span>
                <router-link
                    :to="{ name: 'Home' }"
                    class="pl-1 text-lg nunito tracking-wide font-extrabold text-gray-600 uppercase"
                    >Eaglewealth</router-link
                >
            </div>
            <!-- Desktop Navigation -->
            <div class="mr-12 md:block hidden sticky top-0">
                <router-link
                    active-class="bg-gradient-to-tr from-indigo-700 to-indigo-400 text-white rounded-lg border-transparent"
                    class="px-4 mx-1 py-2 text-sm font-bold text-grey-500 nunito"
                    :class="[this.$route.name === link.to.name ? '' : '']"
                    v-for="(link, i) in links"
                    :key="i"
                    :to="link.to"
                    >{{ link.name }}</router-link
                >
            </div>
            <!--/ Desktop Navigation -->
            <!-- Mobile Navigation -->
            <button class="md:hidden mr-6" @click="ToggleNavBar">
                <span class="cursor-pointer">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7"
                        />
                    </svg>
                </span>
            </button>
            <div
                class="md:hidden absolute w-full bg-slate-800"
                v-if="shouldShow"
            >
                <div class="mt-48">
                    <button 
					 @click="ToggleNavBar"
					class="text-white text-3xl float-right block mr-4">
                        &times;</button
                    ><br />
                    <router-link
                        active-class="bg-slate-900"
                        class="text-white hover:bg-slate-900 px-6 py-2 block text-lg nunito"
                        v-for="(link, i) in links"
                        :to="link.to"
                        :key="i"
                        >{{ link.name }}</router-link
                    >
                </div>
            </div>
            <!--/ Mobile Navigation -->
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const links = [
    { name: "Home", to: { name: "Home" } },
    { name: "About us", to: { name: "About" } },
    { name: "Faq", to: { name: "Faq" } },
    // { name: "Get started", to: { name: "Getstarted" } },
    { name: "Login", to: { name: "Login" } },
    { name: "Customer serveices", to: { name: "CustomerService" } },
];

const shouldShow = ref(false);

const ToggleNavBar = () => {
	shouldShow.value = !shouldShow.value;
}
</script>

<style scoped>
.image {
    height: 3rem;
    width: 3rem;
}
</style>
