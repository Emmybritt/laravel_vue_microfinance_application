<template>
    <form
        @submit.prevent="login"
        class="flex flex-col justify-center items-center mx-auto caret-transparent rounded"
    >
        <div class="px-3 py-2 shadow-lg bg-white rounded-md">
            <div class="flex justify-center items-center">
                <img
                    src="../assets/eaglewealthlogo.jfif"
                    class="logo rounded"
                    alt=""
                />
            </div>
            <h1
                class="text-center text-3xl font-extrabold text-indigo-800 mb-4"
            >
                Login into your account
            </h1>
            <router-link
                :to="{ name: 'Register' }"
                class="text-indigo-600 font-medium text-sm flex justify-center"
                ><span class=""
                    >Don't have an account register here</span
                ></router-link
            >
            <div>
                <ul
                    v-if="errorMsgs"
                    class="bg-pink-500 rounded flex px-2 items-center text-white justify-between"
                >
                    <li v-for="errors in errorMsgs.number" :key="errors">
                        {{ errors }}
                    </li>
                    <span
                        class="text-white cursor-pointer"
                        @click="errorMsgs = null"
                        >&times;</span
                    >
                </ul>
                <p
                    class="bg-pink-500 rounded flex px-2 items-center text-white justify-between"
                    v-else-if="errorMsg"
                >
                    <span>{{ errorMsg }}</span>
                    <span
                        class="text-white cursor-pointer"
                        @click="errorMsg = null"
                        >&times;</span
                    >
                </p>
            </div>
            <div class="mt-4">
                <div class="flex flex-col">
                    <label
                        for="text"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Phone Number</label
                    >
                    <input
                        type="text"
                        id="text"
                        class="appearance-none rounded-t-md relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Phone number"
                        v-model="user.number"
                        autocomplete="password"
                        required
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="text"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Password</label
                    >
                    <input
                        type="text"
                        id="password"
                        autocomplete="Password"
                        v-model="user.password"
                        required
                        class="appearance-none relative rounded-b-md block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Enter your secret password"
                    />
                </div>
            </div>
            <div class="md:flex justify-between mt-6">
                <div>
                    <input type="checkbox" v-model="user.remember" />
                    <span class="font-medium pl-2">Remember me</span>
                </div>
                <p class="text-indigo-600 font-medium text-sm">
                    Forgot your password?
                </p>
            </div>
            <button
                :disabled="loading"
                :class="[loading ? 'opacity-80' : '']"
                class="text-white bg-gradient-to-r tracking-wider from-indigo-900 to-red-900 w-full rounded-lg mt-4 py-1.5"
            >
                {{ loading ? "Please wait..." : "Login" }}
            </button>
        </div>
    </form>
</template>

<script setup>
import store from "../store";
import { useRouter } from "vue-router";
import { ref, computed } from "vue";

const user = {
    number: "",
    password: "",
    remember: false,
};
let errorMsg = ref(null);
let errorMsgs = ref(null);

const router = useRouter();
const loading = ref(false);
function login() {
    loading.value = true;
    store
        .dispatch("login", user)
        .then(({ data }) => {
            loading.value = false;
            router.push({
                name: "Dashboard",
            });
        })
        .catch((err) => {
            loading.value = false;
            errorMsg.value = err.response.data.error;
            errorMsgs.value = err.response.data.errors;
        });
}

function removeError() {
    errorMsg.value = "";
}
</script>

<style>
.logo {
    height: 5rem;
    width: 5rem;
}
</style>
