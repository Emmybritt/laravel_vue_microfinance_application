<template>
    <div class="bg-slate-100 h-screen text-gray-700">
        <BreadCrum title="transactions" />
        <div class="px-6 py-3">
            <div class="flex flex-col md:flex-row">
                <router-link
                    :to="{ name: 'Dashboard' }"
                    class="text-sm bg-gray-700 text-white rounded px-2 py-1"
                    ><span class="las la-angle-left"></span> Go
                    back</router-link
                >
                <router-link
                    :to="{ name: 'Dashboard' }"
                    class="text-sm ml-3 bg-emerald-600 text-white rounded px-2 py-1"
                    ><span class="las la-angle-left"></span> View recent
                    transactions
                </router-link>
                <button
                    class="text-sm ml-3 bg-red-600 text-white rounded px-2 py-1"
                >
                    <span class="las la-angle-left"></span> Delete All
                    transactions
                </button>
            </div>
        </div>
        <div class="bg-white shadow-md p-3 mr-4 my-4 rounded">
            <div class="flex justify-between py-2 items-center">
                <h1 class="font-extrabold text-2xl tracking-wider">
                    Credit an account
                </h1>
                
                <form @submit.prevent="ShowUser">
                    <button
                        class="text-sm shadow-md py-2 rounded-md focus:ring flex items-center justify-between space-x-2 focus:ring-gray-200 focus:ring-offset-2 bg-gray-100 px-2"
                    >
                        <span>{{ ShouldShow ? "Hide account" : "confirm account "
                        }}</span>
                        <i class="las la-eye"></i>
                    </button>
                </form>
            </div>
            <hr />
            <div class="mt-7">
                <form>
                    <div class="md:flex md:space-x-4">
                        <div class="flex flex-col md:w-1/3">
                            <label
                                for="account_number"
                                class="font-medium capitalize mb-2 text-sm"
                                >Search for account number</label
                            >
                            <input
                                id="account_number"
                                v-model="accountdetails.data.account_number"
                                type="number"
                                placeholder="search for account number to credit"
                                class="outline-none border border-indigo-100 text-indigo-600 capitalize focus:outline focus:outline-indigo-200 rounded-lg px-5 py-3"
                            />
                        </div>
                        <div class="flex flex-col md:w-1/3">
                            <label
                                for="account_number"
                                class="font-medium capitalize mb-2 text-sm"
                                >Amount to be credited</label
                            >
                            <input
                                id="account_number"
                                v-model="accountdetails.data.amount_paid"
                                type="number"
                                placeholder="Enter Amount to be credited"
                                class="outline-none border border-indigo-100 text-indigo-600 capitalize focus:outline focus:outline-indigo-200 rounded-lg px-5 py-3"
                            />
                        </div>
                        <div class="flex flex-col md:w-1/3">
                            <label
                                for="account_number"
                                class="font-medium capitalize mb-2 text-sm"
                                >Enter payment date</label
                            >
                            <input
                                id="account_number"
                                v-model="accountdetails.data.payment_day"
                                type="date"
                                placeholder="search for account number to credit"
                                class="outline-none border w-full border-indigo-100 text-indigo-600 focus:outline focus:outline-indigo-200 rounded-lg px-5 py-3"
                            />
                        </div>
                    </div>
                </form>
                <div class="flex mt-4" v-if="accountdetails.data.account_number">
                    <div class="w-1/2">
                        <!-- <form @submit.prevent="creditAccount"> -->
                            <button
                                class="bg-indigo-600 w-full focus:ring focus:ring-indigo-300 focus:ring-offset-2 mr-2 text-white py-3 rounded px-3 font-medium"
                            >
                                Credit Account
                            </button>
                        <!-- </form> -->
                    </div>
                    <div class="w-1/2">
                        <!-- <form @submit.prevent="DebitAccount"> -->
                            <button
                                class="w-full bg-slate-600 focus:ring focus:ring-slate-300 focus:ring-offset-2 ml-2 text-white py-3 rounded px-3 font-medium"
                            >
                                Debit Account
                            </button>
                        <!-- </form> -->
                    </div>
                </div>
                <!-- <div class="bg-red-500 text-white text-sm mt-2 rounded">
                  <div class="px-3">
                    <div v-if="errorMsg">
                    <ul v-for="details_error in errorMsg.details" :key="details_error">
                      <li>{{details_error}}</li>
                    </ul>
                  </div>
                  <div v-show="errorMsg.amount_paid">
                    <ul v-for="amount_paid_error in errorMsg.amount_paid" :key="amount_paid_error">
                      <li>{{amount_paid_error}}</li>
                    </ul>
                  </div>
                  <div v-show="errorMsg.payment_day">
                    <ul v-for="payment_day_error in errorMsg.payment_day" :key="payment_day_error">
                      <li>{{payment_day_error}}</li>
                    </ul>
                  </div>
                  </div>
                </div> -->
                <!-- <pre>{{ accountdetails }}</pre> -->
            </div>
        </div>
        <div
            v-if="ShouldShow"
            class="bg-white shadow-md p-3 mr-4 my-1 rounded"
        >
        <div v-if="userLoading">
          <span><img src="../assets/spinner-2.gif" class="w-6 h-6 inline" alt=""></span>
          Fetching Account Details...
        </div>
        <div class="flex flex-col overflow-x-auto" v-else>
                    <div class="-my-2 sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
                            <div
                                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                            >
                          <p v-if="!account_detail.account_details.length">This account number does not exist </p>
                          <table v-else class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                    >
                                        Account name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                    >
                                        Account number
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                    >
                                        Phone number
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
                              <tr v-for="acct_num in account_detail.account_details" :key="acct_num">
                                  <td class="px-6 py-2 whitespace-nowrap">
                                      <span
                                          class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                                          <img class="h-6 w-6" :src="acct_num.image" alt="">
                                          {{ acct_num.account_name }}
                                      </span>
                                  </td>
                                  <td class="px-6 py-2 whitespace-nowrap">
                                      <span
                                          class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                                          {{ acct_num.account_number }}
                                      </span>
                                  </td>
                                  <td class="px-6 py-2 whitespace-nowrap">
                                      <span
                                          class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                                          {{ acct_num.phone_number }}
                                      </span>
                                  </td>
                                  <td class="px-6 py-2 whitespace-nowrap">
                                      <div class="flex mt-4" v-if="accountdetails.data.account_number">
                                      <div class="w-1/2">
                                          <form @submit.prevent="creditAccount(acct_num.id)">
                                              <button
                                                  class="bg-indigo-600 w-full focus:ring focus:ring-indigo-300 focus:ring-offset-2 mr-2 text-white py-3 rounded px-3 font-medium"
                                              >
                                                  Credit Account
                                              </button>
                                          </form>
                                      </div>
                                      <div class="w-1/2">
                                          <form @submit.prevent="DebitAccount(acct_num.id)">
                                              <button
                                                  class="w-full bg-slate-600 focus:ring focus:ring-slate-300 focus:ring-offset-2 ml-2 text-white py-3 rounded px-3 font-medium"
                                              >
                                                  Debit Account
                                              </button>
                                          </form>
                                      </div>
                                  </div>
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
</template>

<script setup>
import BreadCrum from "../components/BreadCrum.vue";
import { ref, computed, reactive } from "vue";
import { useStore } from "vuex";

const store = useStore();

const ShouldShow = ref(false);
const userLoading = ref(false);
const errorMsg = ref([]);

const account_detail = computed(() => store.state.allAccounts.account_detail);

const accountdetails = reactive({
    data: {
        account_id: null,
        account_number: null,
        details: "credit",
        amount_paid: "",
        balance: null,
        payment_day: "",
    }
});


function creditAccount(id) {
    accountdetails.data.account_id = id;
  if (confirm('are you sure you want to credit this account')) {
      store.dispatch("CreditAccount", accountdetails.data)
      .then((response) => {
      alert('Account has been credited succesfully')
    }).catch(err => {
      errorMsg.value = err.response.data.errors;
    })
  }
}

function DebitAccount(id) {
    accountdetails.data.account_id = id;
    accountdetails.data.details = 'debit';
    if (confirm('are you sure you want to debit this account')) {
      store.dispatch("CreditAccount", accountdetails.data)
      .then((response) => {
      alert('Account has been debited succesfully')
    }).catch(err => {
      errorMsg.value = err.response.data.errors;
    })
  }
}


function ShowUser() {
  userLoading.value = true;
  ShouldShow.value = !ShouldShow.value;
  store.dispatch("getAccountDetail", accountdetails.data.account_number)
  .then(({ data }) => {
      userLoading.value = false;
  })
  .catch((err) => {
      errorMsg.value = err.response.data.errors;
      userLoading.value = false;
  });
}
</script>

<style>
  table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: white;
  cursor: pointer;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th,
td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}
</style>
