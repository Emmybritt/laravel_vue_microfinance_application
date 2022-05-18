<template>
<div class="bg-slate-100 h-screen text-gray-700">
    <BreadCrum title="Expenses" />
    <!-- Searchable form -->
    <div class="bg-white my-4 py-4 px-4 mx-2">
        <form class="flex">
            <div class="w-3/4">
             <input type="search"  v-model="searchField" placeholder="Enter any keyword to search for an expenses..." class="px-5 w-full rounded-full py-3 outline-none border focus:ring-gray-300 border-gray-200">
            </div>
            <button :disabled="isSearching" class="bg-green-600 w-1/4 rounded-full py-2 text-white ml-3 focus:ring focus:ring-offset-2 focus:ring-green-300" @click.prevent="SearchExpenses">{{isSearching ? 'Searching for expenses...' : 'Search Now'}}</button>
        </form>
        <div v-if="SearchResultShouldShow"><hr class="mt-3">
            <p v-if="isSearching" class="flex"><img src="../../assets/Spinner-2.gif" class="h-5 w-5 mr-1" alt=""> Fetching Results...</p>
            <p v-else-if="!Object.keys(searchedExpenses.result).length" class="flex">Searched result not found!!!</p>
            <div v-else>
                <SearchedResult :searchedExpenses="searchedExpenses" :tableHead="table.tableHead" @delete-expenses="RemoveExpense"/>
            </div>
        </div>
    </div>
    <!-- End of searchable form -->

    <div class="sticky right-8 max-w-md px-4 py-3 top-20 text-sm" :class="[notification.type === 'success' ? 'bg-emerald-500 text-white' : 'bg-red-600 text-white']" v-if="notification.show">{{notification.message}}</div>    
    
    <div class="bg-white my-4 pb-4 mx-2">
        <div class="flex justify-between p-3">
            <h1 class="font-bold capitalize tracking-wider text-gray-700">create expenses</h1>
            <div>
            <router-link :to="{name: 'TotalBranches'}" class="text-sm mr-2 border border-gray-200 px-2">Create new branch <i class="las la-plus"></i></router-link>
            <router-link :to="{name: 'AllExpenses'}" href="#" class="text-sm mr-2 border border-gray-200 px-2">View All Expenses <i class="las la-eye"></i></router-link>
            </div>
        </div><hr>
        <div class="my-3">
            <form @submit.prevent="SubmitExpenses">
                <!-- <pre>{{expenses.data}}</pre> -->
                <div class="grid sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 gap-2 px-4">
                    <div>
                        <div class="flex flex-col">
                            <div class="bg-gray-100 uppercase text-xs font-medium py-1.5 px-4 text-indigo-500">Transaction date</div>
                            <div>
                                <input v-model="expenses.data.trans_date" type="date" class="px-2 w-full outline-none text-sm border focus:ring-gray-300 border-gray-200">
                            </div>
                        </div>
                        <!-- Transaction date error displayer -->
                        <span v-if="errorMessages">
                            <ul>
                                <li v-for="error in errorMessages.trans_date" :key="error" class="text-xs mt-1 text-red-500">{{error}}**</li>
                            </ul>
                        </span>
                    </div>

                <!--/ Transaction date error displayer -->
                <div>
                    <div class="flex flex-col">
                        <div class="bg-gray-100 uppercase text-xs font-medium py-1.5 px-4 text-indigo-500">Service paid for</div>
                        <div>
                            <input v-model="expenses.data.service_paid_for" type="text" placeholder="eg. Nepa bill" class="px-3 capitalize w-full outline-none border focus:ring-gray-300 border-gray-200">
                        </div>
                    </div>
                    <!-- service_paid_for error displayer -->
                            <span v-if="errorMessages">
                                <ul>
                                    <li v-for="error in errorMessages.service_paid_for" :key="error" class="text-xs mt-1 text-red-500">{{error}}**</li>
                                </ul>
                            </span>
                        </div>
                    <!--/ service_paid_for error displayer -->

                    <div>
                    <div class="flex flex-col">
                        <div class="bg-gray-100 uppercase text-xs font-medium py-1.5 px-4 text-indigo-500">Amount per quantity</div>
                        <div>
                            <input v-model="expenses.data.amount_per_quantity" type="number" placeholder="eg. 1500" class="px-3 w-full outline-none border focus:ring-gray-300 border-gray-200">
                        </div>
                    </div>
                    <!-- amount_per_quantity error displayer -->
                    <span v-if="errorMessages">
                        <ul>
                            <li v-for="error in errorMessages.amount_per_quantity" :key="error" class="text-xs mt-1 text-red-500">{{error}}**</li>
                        </ul>
                    </span>
                </div>
                <!--/ amount_per_quantity error displayer -->
                <div>
                    <div class="flex flex-col">
                        <div class="bg-gray-100 uppercase text-xs font-medium py-1.5 px-4 text-indigo-500">Total Amount spent</div>
                        <div>
                            <input v-model="expenses.data.total_amount_spent" type="number" placeholder="eg. 3500" class="px-3 w-full outline-none border focus:ring-gray-300 border-gray-200">
                        </div>
                    </div>
                    <!-- total_amount_spent error displayer -->
                        <span v-if="errorMessages">
                            <ul>
                                <li v-for="error in errorMessages.total_amount_spent" :key="error" class="text-xs mt-1 text-red-500">{{error}}**</li>
                            </ul>
                        </span>
                </div>
                <!--/ total_amount_spent error displayer -->
                <div>
                    <div class="flex flex-col">
                        <div class="bg-gray-100 uppercase text-xs font-medium py-1.5 px-4 text-indigo-500">Branch</div>
                        <div>
                            <select v-model="expenses.data.branch_id" class="px-3 w-full outline-none border focus:ring-gray-300 border-gray-200">
                                <option disabled>{{branches.loading ? 'fetching all branches...': 'Select the branch that perform this Transaction'}}</option>
                                <option disabled v-show="!branches.data.data">No branch have been created or wait for branch loading to finish</option>
                                <option v-for="branch  in branches.data.data" :key="branch.id" :value="branch.id">{{branch.branch_number}}</option>
                            </select>
                        </div>
                    </div>
                    <!-- branch_id error displayer -->
                            <span v-if="errorMessages">
                                <ul>
                                    <li v-for="error in errorMessages.branch_id" :key="error" class="text-xs mt-1 text-red-500">{{error}}**</li>
                                </ul>
                            </span>
                    </div>
                    <!--/ branch_id error displayer -->
                </div>
                <div class="flex mx-3 my-4">
                    <button :class="[isSubmitting ? 'bg-green-500': 'bg-green-600 ']" :disabled="isSubmitting" class="rounded-full focus:ring focus:ring-offset-2 focus:ring-green-300 py-2 text-white w-full mr-1">{{isSubmitting ? 'Submission in progress, please wait...' : 'Submit expenses'}}</button>
                    <input type="reset" class="bg-slate-800 focus:ring focus:ring-offset-2 focus:ring-slate-300 rounded-full py-2 text-white w-full ml-1" value="Reset form" />
                </div>
            </form>
            <div>
                <button v-show="errorMessages" @click="errorMessages = null" class="bg-gray-700 text-white px-3 py-2">Remove errors</button>
            </div>
    </div>
    </div>
    <!-- Recent transaction -->
    <div class="bg-white my-4 py-4 px-4 mx-2">
        <RecentTransaction 
            :tableHead="table.tableHead" 
            :recentExpenses="recentTrans" 
            :loading="loading"
            @delete-expenses="RemoveExpense"
        />
        <div class="mb-4 mt-3">
            <span class="font-bold text-xl text-indigo-700 tracking-wider">Total expenses</span>: 
            <span>{{ totalExpense.totalExpenses }}</span>
        </div>
    </div>
</div>
    
</template>

<script setup>
import BreadCrum from '../../components/BreadCrum.vue'
import {ref, reactive,computed, onMounted} from 'vue'
import {useStore} from 'vuex'
import RecentTransaction from '../../components/RecentTransaction.vue'
import SearchedResult from '../../components/SearchedResult.vue' 

const store = useStore();

const searchField = ref('');
const SearchResultShouldShow = ref(false);


store.dispatch('GetAllBranches');
const isSubmitting = ref(false);
store.dispatch("GetExpensesBalance");

const branches = computed(() => store.state.branches);
const errorMessages = ref(null);

const notification = computed(() => store.state.notification);
const loading = computed(() => store.state.expenses.loading);

const searchedExpenses = computed(() => store.state.expenses.searchedExp);
const totalExpense = computed(() => store.state.expenses)
const expenses = reactive({
    data: {
        trans_date: '',
        service_paid_for: '',
        amount_per_quantity: '',
        total_amount_spent: '',
        branch_id: null,
    }
})

const table = reactive({
    tableHead: ['Transaction date', 'Service paid for', 'Amount per quantity', 'Total amount spent', 'created day', 'action']
})



function SubmitExpenses() {
    isSubmitting.value = true;
    store.dispatch("submitExpenses", expenses.data).then(() => {
        isSubmitting.value = false
        store.commit('notify', {
            type: 'success',
            message: 'Expenses was successfully added to the block'
        });
        store.dispatch("getRecentExpenses");
    }).catch(err => {
        errorMessages.value = err.response.data.errors
        isSubmitting.value = false
    })

}

function RemoveExpense(id) {
    if(confirm('are you sure you want to delete this expenses')){
        store.dispatch("DeleteExpenses", id).then(() => {
        store.dispatch("getRecentExpenses");
        store.commit('notify', {
            type: 'success',
            message: 'Expenses has been deleted sucessfully'
        })
     })
    }
}


const searchErrMsg = reactive({
    msg: null
})
let isSearching = ref(false);

onMounted(() => {
    store.dispatch("getRecentExpenses");
})

const recentTrans = computed(() => JSON.parse(JSON.stringify(store.state.expenses.recentExpenses)));

function SearchExpenses() {
    SearchResultShouldShow.value = true;
    isSearching.value = true;

    store.dispatch('SearchForExpenses', searchField.value).then(() => {
    isSearching.value = false;
    }).catch(err => {
        searchErrMsg.msg = err.response.data.errors;
        isSearching.value = false;
    })
}



</script>

<style scoped></style>
