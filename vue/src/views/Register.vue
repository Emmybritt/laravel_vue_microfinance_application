<template>
    <form
        @submit.prevent="register"
        class="flex flex-col justify-center selection:bg-red-400 selection:text-white items-center mx-auto caret-transparent rounded"
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
                Create an account for free
            </h1>
            <router-link
                :to="{ name: 'Login' }"
                class="text-indigo-600 font-medium text-sm flex justify-center"
                ><span class=""
                    >Already have an account login here</span
                ></router-link
            >
            <!-- Error message -->
            <div
                v-if="errorMsg"
                class="flex bg-pink-600 text-white justify-between items-center rounded px-3 py-1"
            >
                <span class="text-sm">{{ errorMsg }}</span>
                <span
                    @click="errorMsg = ''"
                    class="text-lg font-bold hover:bg-pink-700 rounded-full px-2 cursor-pointer"
                    >&times;</span
                >
            </div>
            <!-- Error message -->
            <div class="mt-4">
                <div class="flex flex-col">
                    <label
                        for="fullname"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Full name</label
                    >
                    <input
                        required
                        type="text"
                        id="fullname"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none rounded-t-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Full name"
                        v-model="user.full_name"
                        autocomplete="current-fullname"
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="prefered_name"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >preferrable name to be called</label
                    >
                    <input
                        required
                        type="text"
                        id="prefered_name"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Nickname"
                        v-model="user.other_name"
                        autocomplete="current-nickname"
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="email"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Email Address</label
                    >
                    <input
                        required
                        type="text"
                        id="email"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Email address"
                        autocomplete="current-email"
                        v-model="user.email"
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="number"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Phone number e.g (+23470456349)</label
                    >
                    <input
                        required
                        type="tel"
                        id="number"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Phone number (+2347016588973)"
                        v-model="user.phone_number"
                        autocomplete="current-phone-number"
                    />
                </div>
                <input type="hidden" v-model="user.role" />
                <div class="flex flex-col">
                    <label
                        for="text"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Home address</label
                    >
                    <input
                        required
                        type="text"
                        id="text"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Home address"
                        autocomplete="current-home-address"
                        v-model="user.address"
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="password"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Password</label
                    >
                    <input
                        required
                        type="password"
                        id="password"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Choose a strong password"
                        autocomplete="current-password"
                        v-model="user.password"
                    />
                </div>
                <div class="flex flex-col">
                    <label
                        for="password_confirmation"
                        class="text-gray-900 font-medium text-sm mb-0.5 sr-only"
                        >Confirm your password</label
                    >
                    <input
                        required
                        type="password"
                        id="password_confirmation"
                        class="appearance-none relative block w-full px-3 py-1.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Confirm password"
                        autocomplete="current-password_confirmation"
                        v-model="user.password_confirmation"
                    />
                </div>
            </div>
            <div class="md:flex justify-between item-center space-x-2 mt-4">
                <div>
                    <input required type="checkbox" id="checked" />
                    <label for="checked" class="font-medium pl-2 text-sm"
                        >Read and accept terms and conditions</label
                    >
                </div>
                <p class="text-indigo-600 font-medium text-sm">
                    Forgot your password?
                </p>
            </div>
            <button
              :disabled="loading"
                class="text-white bg-gradient-to-r focus:ring-1 focus:ring-offset-2 focus:ring-indigo-300 tracking-wider from-indigo-900 to-red-900 w-full rounded-lg mt-4 py-1.5"
            >
                {{ loading ? 'Please wait...' :  'Sign up' }}
            </button>
        </div>
    </form>
</template>

<script setup>
// import { useStore } from 'vuex'
import { useRouter } from "vue-router";
import store from "../store";
import { ref } from "vue";
import { computed } from 'vue';

const router = useRouter();

const user = {
    full_name: "",
    other_name: "",
    role_id: 1,
    role: 'super_admin',
    email: "",
    phone_number: "",
    branch_number: "NIL",
    address: "",
    password: "",
    password_confirmation: "",
};
const errorMsg = ref("");

const loading = computed(() => store.state.user.isLoading);

function register() {
  store.dispatch("register", user)
      .then(({ data }) => {
          router.push({
            name: "Dashboard",
          });
      });
}
</script>

<style></style>
