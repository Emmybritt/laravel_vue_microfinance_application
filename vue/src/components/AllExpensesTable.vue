<template>
  <div class="pt-0.5">
    <div class="flex flex-col overflow-x-auto mt-5">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                >
                <div v-if="loading" class="my-2 text-xs text-gray-600"><img src="../assets/Spinner-2.gif" alt="" class="mr-1 h-5 w-5 inline"> Loading Expenses...</div>
                <div v-else
                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                            v-for="head in tableHead" :key="head"
                                scope="col"
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                            >
                                {{ head }}
                            </th> 
                        </tr>
                    </thead>
                    <tbody v-if="expenses">
                        <tr v-for="exp in expenses" :key="exp" class="divide-x divide-y w-full text-sm text-gray-700">
                            <td class="border border-b">{{exp.trans_date}}</td>
                            <td>{{exp.service_paid_for}}</td>
                            <td>{{exp.amount_per_quantity}}</td>
                            <td>{{exp.total_amount_spent}}</td>
                            <td>{{moment(exp.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</td>
                            <td class="flex items-center">
                                <router-link 
                                class="text-xs text-white  px-2 mx-1 py-1 rounded bg-emerald-500"
                                :to="{name: 'ViewExpenses', params: {id: exp.id}}">view</router-link>
                                <div class="text-xs text-white  px-2 mx-1 py-1 rounded bg-red-500"><button @click="$emit('deleteExpenses', exp.id)"><i class="las la-trash"></i></button></div>
                            </td>
                        </tr>
                        <tr class="divide-y">
                            <td><p class="font-medium text-sm text-gray-600">Total Expenses</p></td>
                            <td></td>
                            <td></td>
                            <td class="border border-b font-medium text-indigo-600 tracking-wider">{{val}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="m-3">
            <a 
            v-for="(link, i) of pagelinks" :key="i"
            :disabled="!link.url"
            href="#"
            @click.prevent="$emit('getForPage', link)"
            aria-current="page"
            v-html="link.label"
            :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',  i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '', i === pagelinks.length - 1 ? 'rounded-r-md' : '']"
            class="relative whitespace-nowrap font-medium text-xs inline-flex items-center px-4 py-2 border"
            ></a>
        </div>
    </div>
  </div>
</template>

<script setup>
import {ref, reactive, computed, onMounted} from 'vue';
import moment from 'moment'

const props = defineProps({
    tableHead: Array,
    expenses:Array,
    loading:Boolean,
    pagelinks:Array,
    val:Number,
})


defineEmits(['deleteExpenses', 'getForPage']);




</script>

<style>

</style>