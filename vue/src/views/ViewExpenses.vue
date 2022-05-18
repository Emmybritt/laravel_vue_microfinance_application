<template>
  <div class="h-screen">
    <BreadCrum title="Expenses" />
      <div class="bg-white px-3 py-2 mt-2">
        <div class="flex justify-between">
            <button  onclick="history.back()" class="text-sm bg-gray-700 text-white rounded px-2 py-1">Go back</button>
            
            <button
            @click="DeleteExpenses"
                class="text-sm ml-3 bg-red-600 text-white rounded px-2 py-1"
            >
                Delete Expenses
            </button>
        </div>
      </div>
      <div class="bg-white px-3 py-2 mt-2">
        <div v-if="isLoading" class="flex">
          <img src="../assets/Spinner-2.gif" class="h-5 w-5 mr-1" alt="">
          <span>Fetching expenses please wait...</span>
        </div>
        <div v-else>
          <div class="border divide-y p-3" v-if="Expenses">
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Service paid for:</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.service_paid_for}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Transaction date:</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.trans_date}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Amount per quantity:</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.amount_per_quantity}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Total amount spent:</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.total_amount_spent}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Created date</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{moment(Expenses.expenses.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Created by</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.user.name}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Branch name</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.branch.branch_name}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Branch number</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.branch.branch_number}}</span>
            </div>
            <div class="flex py-2 items-center">
              <span class="font-medium tracking-wider text-gray-700">Branch address</span> <span class="ml-4 text-indigo-600 text-sm capitalize font-medium">{{Expenses.expenses.branch.branch_address}}</span>
            </div>
          </div>
        </div>
        
        <!-- <pre>{{Expenses}}</pre> -->
      </div>
  </div>
</template>

<script setup>
import BreadCrum from '../components/BreadCrum.vue';
import {useRoute} from 'vue-router';
import {useStore} from 'vuex';
import {computed, reactive, ref} from 'vue'
import moment from 'moment'

const Expenses = computed(() => JSON.parse(JSON.stringify(store.state.expenses.singleExpenses)));
const notify = computed(() => store.state.expenses)

// const moment = moment()

const isLoading = ref(false);



const store = useStore();
const route = useRoute();


if (route.params.id) {
  isLoading.value = true;
  store.dispatch('GetExpenses', route.params.id).then(() => {
    isLoading.value = false;
  }).catch(err => {
    isLoading.value = false;
  })
}

function DeleteExpenses() {
  if (confirm('Are you sure you want to delete this expenses')) {
    store.dispatch("DeleteExpenses", id).then(() => {
        store.dispatch("getRecentExpenses");
        store.commit('notify', {
            type: 'success',
            message: 'Expenses has been deleted sucessfully'
        })
     })
  }
}

</script>

<style>

</style>