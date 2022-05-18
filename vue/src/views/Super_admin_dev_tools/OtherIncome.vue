<template>
  <div class="h-screen">
    <BreadCrum title="Other income" />
      <div>
          <div class="bg-white shadow-md mt-2 px-2 py-1">
              <button class="bg-gray-800 px-2 py-1 text-white text-sm" onclick="history.back()">Go back</button>
              <button @click="ShowForm" class="bg-green-800 px-2 py-1 text-white text-sm ml-2">Add new Income <i class="las la-plus"></i></button>
              <router-link :to="{name: 'TotalIncome'}" class="text-sm px-2 py-1 ml-2 text-gray-700 border">View all added income <i class="las la-eye"></i></router-link>
          </div>





          <!-- Notification here -->
          <div v-if="notification.show" class="absolute right-0 bg-gray-600 text-white px-4 py-2" style="background:rgba(0,0,0,0.7)">
              {{ notification.message }}
          </div>
          <!-- Notification ends here -->





          <!-- Form Modal here -->
          <Teleport to="body">
            <Transition name="fade" duration="550">
        <div
            style="background: rgba(0, 0, 0, 0.5)"
            class="absolute h-screen mx-auto flex justify-center items-center top-0 left-0 right-0 bottom-0"
            v-if="FormShouldShow"
        >
            <div class="bg-white shadow-md px-4 rounded py-3 w-[800px]">
                <div class="flex justify-between">
                    <h1 class="text-2xl inline border-b-2 border-indigo-300 font-bold tracking-wide">
                        Add new income
                    </h1>
                    <!-- <pre>{{account}}</pre> -->
                    <span
                        class="text-3xl cursor-pointer"
                        @click="HideForm"
                        >&times;</span
                    >
                </div>
                <div class="mt-4">
                    <form @submit.prevent="Submit">
                        <!-- <pre>{{ otherIncome }}</pre> -->
                        <div class="flex">
                            <div class="flex flex-col w-1/2 mr-1">
                                <label for="Amount">Amount</label> 
                                <input type="number" 
                                v-model="otherIncome.amount" 
                                placeholder="Amount" 
                                class="outline-none border px-2 py-1 rounded focus:outline focus:outline-offset-2 focus:outline-indigo-300">
                            </div>
                            <div class="flex flex-col w-1/2 ml-1">
                                <label for="Amount">Income Type</label> 
                                <input type="text" v-model="otherIncome.incomeType" placeholder="Details" class="outline-none border px-2 py-1 rounded focus:outline focus:outline-offset-2 focus:outline-indigo-300">
                            </div>
                        </div>
                        <div class="md:flex mt-3 space-y-2 md:space-y-0">
                            <button class="w-full bg-indigo-600 text-center py-1 md:mr-1 text-white focus:outline focus:outline-offset-2 focus:rounded focus:outline-indigo-300">{{isLoadingState ? 'submitting...' : 'Submit'}}</button>
                            <input type="reset" value="Reset form" class="w-full bg-gray-800 text-center py-1 md:ml-1 text-white focus:outline focus:rounded focus:outline-offset-2 focus:outline-gray-300" />
                        </div>
                        
                    </form>
                </div>
              <div>
        </div>
    </div>
        </div>
        </Transition 
       >
        </Teleport>
          <!-- Form Modal ends here -->
          <div class="bg-white shadow-md mt-2 px-2 py-1">
              <h1>Recently Added</h1><hr>
              <div v-if="isFetchingRecentincome" class="flex mt-2">
                  <img src="../../assets/Spinner-2.gif" class="h-5 w-5 mr-1" alt="">
                  <p class="text-xs">Please wait while recent income added is being fetched...</p>
              </div>
              <div v-else>
                  <div class="flex flex-col overflow-x-auto mt-5 mx-4">
                    <div class="-my-2 sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
                            <div
                                class="shadow overflow-hidden border-b bg-white border-gray-200 sm:rounded-lg"
                            >
                                <IncomeTable  :recentIncome="recentIncome"/>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    
  </div>
</template>

<script setup>
// Total importations starts here
import BreadCrum from '../../components/BreadCrum.vue'
import {ref, reactive, computed} from 'vue';
import {useStore} from 'vuex';
import IncomeTable from '../../components/OtherIncome/IncomeTable.vue'
// Importation ends here

// Variables starts here
const FormShouldShow = ref(false);
const isLoadingState = ref(false);
const store = useStore();
const isFetchingRecentincome = ref(true);
// Variables ends here

// Functions and computed methods starts here
const notification = computed(() => store.state.notification);
const recentIncome = computed(() => store.state.otherIncome.data);
function HideForm() {
    FormShouldShow.value = !FormShouldShow.value;
}

function ShowForm() {
    FormShouldShow.value = !FormShouldShow.value;
}

const otherIncome = reactive({
        amount: null,
        incomeType: '',
})

function Submit() {
    isLoadingState.value = true;
    store.dispatch("submitOtherIncome", otherIncome).then(() => {
        isLoadingState.value = false;
        FormShouldShow.value = false;
        otherIncome.amount = null
        otherIncome.incomeType = '';
        store.commit("notify", {
            message: 'Income successfully created',
            type: 'success',
        })
    }).catch(err => {
        isLoadingState.value = false;
        console.log(err.response.data.errors);
    })
}
// Functions and methods ends here

store.dispatch("getRecentAddedIncome").then(() => {
    isFetchingRecentincome.value = false;
}).catch(err => {
    isFetchingRecentincome.value = false;
})





</script>

<style>

</style>