<template>
   <div class="min-h-screen">
    <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
    <BreadCrum :title="'accounts ' + account.account_name" />
    <div
        v-if="loading"
        class="mt-4 flex flex-row text-green-800 justify-center items-center"
    >
        <img src="../assets/Spinner-2.gif" class="rounded-full h-5 w-5 mr-1" />
        Please wait while account details is being fetched...
    </div>
    <div v-else>
        <div class="bg-white m-3 overflow-y-auto">
            <div class="flex justify-between items-center border-b pb-2 border-indigo-200 p-6">
                <h1 class="font-medium">{{account.account_name}}</h1>
                <button onclick="history.back()" class="text-sm">Go back</button>
            </div>
            <div class="md:flex mt-6 divide-x">
                <div class="md:w-1/3">
                    <div class="p-6">
                        <img src="../assets/download.jfif" alt="default image" class="block mx-auto h-48 ring ring-pink-200 ring-offset-2 w-48 rounded-full sm:mx-0 sm:shrink-0" v-if="!account.image_url">
                        <img v-else :src="account.image_url" class="block mx-auto h-48 ring ring-pink-200 ring-offset-2 w-48 rounded-full sm:mx-0 sm:shrink-0" :alt="account.account_name">
                    </div>
                    <div class="divide-y overflow-x-auto">
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Account name:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.account_name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Other name:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.other_name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Email:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.email_address}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">phone number:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.phone_number}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Address:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.address}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Account number:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.account_number}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Account type:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.account_type}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">created date:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{moment(account.created_at).format('MMMM Do YYYY h:mm:ss a')}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">Account Officer:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium">{{account.registered_by.name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">branch name:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium" v-if="account.branche">{{account.branche.branch_name}}</h1>
                        </div>
                        <div class="flex justify-between border-b mr-6 p-3">
                            <h1 class="font-medium text-gray-700">branch_number:</h1>
                            <h1 class="text-indigo-700 text-sm font-medium" v-if="account.branche">{{account.branche.branch_number}}</h1>
                        </div>
                    </div>
                </div>
                <div class="md:w-2/3 px-6 pt-4">
                    <div class="flex justify-between">
                        <h1 class="font-medium">Update Profile</h1>
                        <button type="button" class="text-sm bg-red-500 hover:bg-red-600 ring ring-red-200 rounded-md py-1 focus:ring-offset-2 text-white px-2">Delete Account</button>
                    </div><hr class="mt-4">
                    <div>
                        <form @submit.prevent="UpdateAccountDetails">
                            <div class="md:flex mt-4">
                                <div class="md:w-1/2 space-y-2 mr-1">
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Account name:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" v-model="account.account_name">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Other name:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" v-model="account.other_name">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Account number</label>
                                    <input type="text" readonly 
                                    class="border rounded block w-full outline-none px-3 text-sm bg-gray-100 font-medium cursive text-gray-600 p-2 mt-1" v-model="account.account_number">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Phone number:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" v-model="account.phone_number">
                                </div>
                            </div>
                            <div class="md:w-1/2 space-y-2 ml-1">
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Email Address:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" v-model="account.email_address">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Home address:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" v-model="account.address">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Change Account Officer</label>
                                    <select
                                    class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1"
                                     >
                                        <option v-for="staff in staffs" value="" :key="staff">emmy</option>
                                    </select>
                                </div>
                               
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Account type:</label>
                                    <select
                                    class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1"
                                    name="" id="">
                                        <option value="">Food stuff</option>
                                        <option value="">Daily</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="mt-6">
                                <button :disabled="isLoading" class="w-full text-center bg-emerald-500 text-white rounded-lg ring ring-emerald-200 focus:ring-offset-2 font-medium py-2">{{isLoading ? 'UPDATING ACCOUNT...' : 'UPDATE ACCOUNT'}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-between mt-6">
                        <div class="w-1/2">
                        <h1 class="mt-3 text-sm font-bold text-gray-600 tracking-wide mb-4 cursor-pointer" @click="ImageShouldShow = !ImageShouldShow">{{ImageShouldShow ? 'Click here to cancel changes' : 'click here to change image'}}</h1>
                            <div v-if="ImageShouldShow">
                                <label for="updateImage" class="rounded-full bg-gray-100 shadow-md text-sm px-3 py-2">Choose image</label>
                                <div v-if="new_image">
                                    <img :src="new_image" alt="" class="w-64 h-28">
                                </div>
                                <input type="file" class="hidden" id="updateImage" @change="onImageChoose">
                            <button class="bg-emerald-500 text-white font-medium px-3 py-2 rounded-full mt-3 ring ring-emerald-200 focus:ring-offset-2 mb-3 ml-2">Update</button>
                            <button @click="new_image = ''" v-show="new_image" class="bg-red-500 text-white font-medium px-3 py-2 rounded-full mt-3 ring ring-red-200 focus:ring-offset-2 mb-3 ml-2">Cancel</button>
                            </div>
                        </div>
                        <div class="w-1/2">
                        <h1 class="mt-3 text-sm text-gray-600 font-bold tracking-wide mb-4 cursor-pointer" @click="passwordChangeShouldShow = !passwordChangeShouldShow">{{ passwordChangeShouldShow ? 'click here to cancel' : 'click here to change password' }}</h1>
                            <form action="" v-if="passwordChangeShouldShow">
                                <div class="block">
                                <label for="name" class=" font-medium text-indigo-600">New Password:</label>
                                <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" placeholder="password">
                                </div>
                                <div class="block">
                                    <label for="name" class=" font-medium text-indigo-600">Confirm Password:</label>
                                    <input type="text" class="border rounded block w-full outline-none px-3 text-sm font-medium cursive text-gray-600 p-2 mt-1" placeholder="confirm password">
                                </div>
                            <button class="bg-emerald-500 text-white font-medium px-3 py-2 rounded-full mt-3 ring ring-emerald-200 focus:ring-offset-2 mb-3">update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="p-4 bg-white overflow-x-auto m-3">
        <div class="flex justify-between">
            <h1 class="font-medium">Account Details</h1>
            <div class="flex space-x-2">
                <p class="text-red-500 text-xs">Remove all transactions</p>
                <router-link class="text-xs" :to="{name: 'UserAccountStatment', params: {id: route.params.id}}">View account statement</router-link>
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
                <i class="lab la-envira text-indigo-500"></i> Account Balance:
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
                <i class="lab la-forumbee text-indigo-500"></i> Total Debit:
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
                <i class="lab la-houzz text-indigo-500"></i> Total credit:
            </span> 
            <span class="text-sm ml-2">
                <img src="../assets/Spinner-3.gif"  class="h-4 w-4 inline" alt="spinner" v-if="isDebitcreditLoading">
                <span v-else>{{accountBalance.totalCredit}}</span>
            </span>
        </div>
    <!-- Total credit ends here -->
    </div>
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
    //  store.dispatch();
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


//  const account = computed(() => store.state.currentAccount.data);
 const loading = computed(() => store.state.currentAccount.loading);

 const ImageShouldShow = ref(false);
 const passwordChangeShouldShow = ref(false);


</script>

<style>

</style>