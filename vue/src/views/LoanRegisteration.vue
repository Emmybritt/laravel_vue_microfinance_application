<template>
    <div class="h-screen">
        <!-- <BreadCrum title="Loan registeration" /> -->
        <div class="px-6 py-3 bg-white mt-2">
            <div class="flex justify-between">
                <button
                    class="text-sm rounded px-2 py-1"
                    onclick="history.back()"
                >
                    <span class="las la-angle-left"></span> Go back
                </button>
                <router-link class="text-sm" :to="{ name: '' }"
                    >View All registered loans</router-link
                >
            </div>
            <hr>
            <div class="mt-3">
                <router-link :to="{name: 'LoanRegisteration'}" :class="{'border-indigo-50 cursor-pointer' : route.params.id}" class="text-xl font-medium text-center border-indigo-500 py-1.5 rounded mb-4 text-gray-700
                 px-3 border-b-2 my-2">{{route.params.id ? 'Register new loan': 'Eagle wealth loan registeration form'}}</router-link>:

                <LoanRegisterationForm />
            </div>
        </div>
    </div>
</template>

<script setup>
import LoanRegisterationForm from '../components/LoanRegisterationForm.vue'
import {v4 as uuidv4} from 'uuid'
import {ref} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {useStore} from 'vuex'

const router = useRouter();
const store = useStore();
const route = useRoute();




</script>

<style></style>
