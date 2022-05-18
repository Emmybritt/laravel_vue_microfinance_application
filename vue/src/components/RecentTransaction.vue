<template>
  <div>
      <h1 class="text-medium">Recent transaction</h1>
            <hr class="mt-1">
            <div class="flex flex-col overflow-x-auto mt-5">
                    <div class="-my-2 sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
                            <div
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
                            <tbody v-if="recentExpenses.expenses">
                                <tr v-for="exp in recentExpenses.expenses.data" :key="exp" class="divide-y w-full text-sm text-gray-700">
                                    <td>{{exp.trans_date}}</td>
                                    <td>{{exp.service_paid_for}}</td>
                                    <td>{{exp.amount_per_quantity}}</td>
                                    <td>{{exp.total_amount_spent}}</td>
                                    <td>{{ moment(exp.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</td>
                                    <td class="flex items-center">
                                        <router-link 
                                        class="text-xs text-white  px-2 mx-1 py-1 rounded bg-emerald-500"
                                        :to="{name: 'ViewExpenses', params: {id: exp.id}}">view</router-link>
                                        <div class="text-xs text-white  px-2 mx-1 py-1 rounded bg-red-500"><button @click="$emit('deleteExpenses', exp.id)"><i class="las la-trash"></i></button></div>
                                    </td>
                                </tr>
                            </tbody>
                          </table>
                          <div v-if="loading" class="my-2"><img src="../assets/Spinner-2.gif" alt="" class="mr-2 h-5 w-5 inline"> Loading recent Expenses...</div>
                        </div>
                    </div>
                </div>
            </div>
  </div>
</template>



<script setup>
import {ref, reactive, computed, onMounted} from 'vue';
import moment from 'moment'

const props = defineProps({
    tableHead: Array,
    recentExpenses: Object,
    loading:Boolean,
})

defineEmits(['deleteExpenses']);



</script>

<style>

</style>