<template>
   <div class="min-h-screen">
    <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
    <div
        v-if="loading"
        class="mt-4 flex flex-row text-green-800 justify-center items-center"
    >
        <img src="../assets/Spinner-2.gif" class="rounded-full h-5 w-5 mr-1" />
        Please wait while account details is being fetched...
    </div>
    <div v-else>
        <div v-if="loanUser.data" class="bg-white m-3 overflow-y-auto">
            <div class="flex justify-between items-center border-b pb-2 border-indigo-200 p-6">
                <h1 class="font-medium">Loan Collector Profile</h1>
                <button onclick="history.back()" class="text-sm">Go back</button>
            </div>
            <div class="md:flex mt-6 divide-x">
                <div class="md:w-1/2">
                    <div class="p-6">
                        <img src="../assets/download.jfif" alt="default image" class="block mx-auto h-48 ring ring-pink-200 ring-offset-2 w-48 rounded-full sm:mx-0 sm:shrink-0" v-if="!account.image_url">
                        <img v-else :src="loanUser.data.image_url" class="block mx-auto h-48 ring ring-pink-200 ring-offset-2 w-48 rounded-full sm:mx-0 sm:shrink-0" :alt="account.account_name">
                    </div>
                    <div class="divide-y overflow-x-auto">
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">full name:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.full_name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Nationality:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.nationality}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Gender:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.gender}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">phone number:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.phone_number}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">State of origin:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.state}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Loan id number:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.loan_number}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Loan type:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.loan_type}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Residential address:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.residential_address}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Occupation:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.occupation}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Registration date:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{moment(loanUser.data.created_at).format('MMMM Do YYYY h:mm:ss a')}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Branch ID:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.branch}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Registered by:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.registered_by}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Nature of business:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.nature_of_business}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Method of payment:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.method_of_payment}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Date to starts payment:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.day_of_payment}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Mandatory savings:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.mandatory_savings}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Default fee:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.default_fee}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Collateral:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.collateral}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Duration of payment:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium" v-if="account.branche">{{loanUser.data.duration}} Months</h1>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 px-6 pt-4">
                    <div class="flex justify-between">
                        <h1 class="font-medium">Guarantors Details</h1>
                        <!-- <button type="button" class="text-sm bg-red-500 hover:bg-red-600 ring ring-red-200 rounded-md py-1 focus:ring-offset-2 text-white px-2">Delete Account</button> -->
                    </div><hr class="mt-4">
                    <div v-if="loanUser.data.guarantors" class="overflow-y-auto h-[20rem]">
                        <div v-for="(guarantor, i) in loanUser.data.guarantors" :key="guarantor.id" class="divide-y overflow-x-auto">
                            <p class="text-sm text-slate-500">Guarntor {{ i + 1 }}</p>
                            <div>
                                <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Fulname:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{guarantor.full_name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Gender:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{guarantor.gender}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Relationship with loan user:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{guarantor.relationship}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Phone number:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{guarantor.phone_no}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Occupation:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{guarantor.occupation}}</h1>
                        </div>
                            </div>
                        
                    </div>
                    </div>
                    <div class="mt-6">
                        <div class="" v-if="loanUser.data.nextOfKin">
                        <h1 class="mt-3 text-sm font-bold text-gray-600 tracking-wide mb-4 cursor-pointer">Next of Kin details</h1>
                            <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Name:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.nextOfKin.name}}</h1>
                            </div>
                            <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Address:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.nextOfKin.address}}</h1>
                            </div>
                            <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Phone number:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.nextOfKin.phone_no}}</h1>
                            </div>
                            <div class="flex justify-between border-b mr-6 p-2">
                            <h1 class="font-medium text-gray-700 text-sm">Relationship:</h1>
                            <h1 class="text-indigo-700 text-xs font-medium">{{loanUser.data.nextOfKin.relationship}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="p-4 bg-white overflow-x-auto m-3">
        <div class="flex justify-between">
            <h1 class="font-medium">Total Payments</h1>
            <div class="flex space-x-2">
                <p class="text-red-500 text-xs">Remove all transactions</p>
            </div>
        </div><hr class="mt-2">
        <div>
            <div class="flex flex-col w-[1080px]">
                <div class="-my-2 sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div v-if="LoadingState">Fetching transactiion...</div>
                        <div v-else-if="!Object.values(account_trans.account_trans).length" class="text-xs">No amount have been pasted to this account!!!</div>
                <div v-else class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Payment date
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Details
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Amount paid
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Payment date & time
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Last updated
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Creditor
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                >
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(tran, i) in account_trans.account_trans" :key="i">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        {{ tran.payment_day }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        {{ tran.details }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        {{ tran.amount_paid }}
                                    </span>
                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        {{moment(tran.created_at).format('MMMM Do YYYY h:mm:ss a') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        {{ moment(tran.updated_at).format('MMMM Do YYYY h:mm:ss a') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 rounded-full text-green-800"
                                    >
                                        Emmy britt
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5"
                                    >
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded-md ring ring-red-200 focus:ring-offset-2">Debit</button>
                                        <button type="button" class="bg-green-500 text-white ml-3 px-3 py-1 rounded-md ring ring-green-200 focus:ring-offset-2">Edit</button>
                                        <router-link :to="{name: 'ViewSingleStatement', params: {id: route.params.id}}" class="bg-indigo-500 text-white ml-3 px-3 py-1 rounded-md ring ring-indigo-200 focus:ring-offset-2">view</router-link>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white my-2 mb-3 mx-3 px-4 py-2 flex-col flex">
        <!-- Total Balance starts here -->
        <div>
            <span class="text-sm font-medium text-gray-700">
                <i class="lab la-envira text-indigo-500"></i> Amount borrowed:
            </span> 
            <span class="text-sm ml-2">
                <img src="../assets/Spinner-3.gif"  class="h-4 w-4 inline" alt="spinner" v-if="isDebitcreditLoading">
                <span v-else>{{ getTotalBalance }}</span>
            </span>
        </div>
        <!-- Total Balance ends here -->
        <!-- Total Debit starts here -->
        <div>
            <span class="text-sm font-medium text-gray-700">
                <i class="lab la-forumbee text-indigo-500"></i> Total Amounts paid:
            </span> 
            <span class="text-sm ml-2">
                <img src="../assets/Spinner-3.gif"  class="h-4 w-4 inline" alt="spinner" v-if="isDebitcreditLoading">
                <span v-else>{{accountBalance.totalDebit}}</span>
            </span>
        </div>
        <!-- Total Debit ends here -->
        <!-- Total credit starts here -->
        <div>
            <span class="text-sm font-medium text-gray-700">
                <i class="lab la-houzz text-indigo-500"></i> Remaining balance:
            </span> 
            <span class="text-sm ml-2">
                <img src="../assets/Spinner-3.gif"  class="h-4 w-4 inline" alt="spinner" v-if="isDebitcreditLoading">
                <span v-else>{{accountBalance.totalCredit}}</span>
            </span>
        </div>
    <!-- Total credit ends here -->
    </div>
    <!-- <pre>{{loanUser}}</pre> -->
   </div>
   </div>    
</template>

<script setup>
    import Header from '../components/Header.vue'
    import BreadCrum from '../components/BreadCrum.vue'
    import {useStore} from 'vuex';
    import {ref, computed, watch} from 'vue';
    import {useRouter, useRoute} from 'vue-router'
    import moment from 'moment'

    const store = useStore();
    const router = useRouter(); 
    const route = useRoute();
    const isLoading = ref(false);
    const LoadingState = ref(true);
    const isDebitcreditLoading = ref(true);
    const loading = computed(() => store.state.loan.loading);
    const loanUser = computed(() => store.state.loan.singleUserDetails);

    const account_trans = computed(() => store.state.customers.AllAccountTransactions);
    const accountBalance = computed(() => store.state.accountBalance);

    const getTotalBalance = computed(() => {
        return parseInt(store.state.accountBalance.totalCredit) - parseInt(store.state.accountBalance.totalDebit);
    })

    store.dispatch("getTotalDebitAndCreditTrans", route.params.id).then(() => {
        isDebitcreditLoading.value = false;
    }).catch(err => {
        isDebitcreditLoading.value = false;
    })


    const staffs = computed(() => store.state.staffs.data)

    const new_image = ref('');

    function onImageChoose(ev) {
      const file = ev.target.files[0];

      const reader = new FileReader();
      reader.onload = () => {
          new_image.value = reader.result;
          ev.target.value = "";
      }
      reader.readAsDataURL(file);

    }

    store.dispatch("GetAllStaffs");


     function ToggleSideBar() {
    store.commit("ChangeStatus");
 }
 
 if (route.params.id) {
     store.dispatch('getAccount', route.params.id);
     store.dispatch('getSingleLoan', route.params.id);
 }

 const account = ref({
     account_name: '',
     other_name: '',
     other_name: '',
     phone_number: '',
     email_address: '',
     address: '',
     user_id: '',
     account_type: '',
    image_url: '',
 });

 store.dispatch("getAccountTransactions", route.params.id).then(() => {
     LoadingState.value = false;
 }).catch(err => {
     LoadingState.value = false;
 });

 function UpdateAccountDetails() {
    //  alert('i am clicked')
     isLoading.value = true;
     store.dispatch("UpdateAccountDetails", {...account.value}).then(({data}) => {
     isLoading.value = false;
     store.commit("notify", {
         type: "success",
         message: "Account was updated succesfully"
     });
     store.dispatch('getAccount', route.params.id);
    })
 }

watch(() => store.state.currentAccount.data, (newVal, oldVal) => {
    account.value = {
        ...JSON.parse(JSON.stringify(newVal)),
        status: !!newVal.status,
    };
});



 const ImageShouldShow = ref(false);
 const passwordChangeShouldShow = ref(false);


</script>

<style>

</style>