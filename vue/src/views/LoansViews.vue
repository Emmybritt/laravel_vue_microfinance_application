<template>
  <div class="h-screen">
    <BreadCrum title="Loan masterall" />
    <div>
      <!-- <div class="flex px-5">
                <div class="rounded-l-lg shadow-md px-5 w-full bg-white shadow-neutral-200 mt-4">
                    <input type="search" v-model="searchQuery" @input="SearchField" placeholder="Search by name or account number..." class="text-lg py-4 appearance-none w-full focus:outline-none" ref="input">
                </div>
                <button class="bg-emerald-500 text-white mt-4 px-3 rounded-r-lg focus:ring hover:bg-emerald-600 focus:ring-offset-2">Search</button>
            </div> -->
      <!-- <div v-show="Output" class="bg-white mx-5 mb-6 px-3 mr-[5.6rem] drop-shadow-md border border-gray-200 py-2">
              <div class="flex justify-between">
                  <div>
                      <p>{{searchQuery}}</p>

                  </div>
                  <span @click="removeDropDown" class="text-2xl cursor-pointer">&times;</span>
              </div>
          </div> -->
      <div class="">
        <div class="flex flex-col md:flex-row bg-white py-2 px-3">
          <button
            onclick="history.back()"
            class="text-sm bg-gray-700 text-white rounded px-2 py-1"
          >
            <span class="las la-angle-left"></span> Go back
          </button>
        </div>
      </div>
      <div class="bg-white p-1">
        <div
          v-if="loading"
          class="mt-4 flex text-green-800 justify-center items-center"
        >
          <img
            src="../assets/Spinner-2.gif"
            class="rounded-full h-5 w-5 mr-2"
          />
          Please wait while all accounts are being fetched...
        </div>
        <div
          v-else-if="!loansRegisters"
          class="mt-4 flex text-green-800 justify-center items-center"
        >
          No loan has benn registered 
        </div>

        <div v-else class="mb-4">
          <div
            class="flex justify-between items-center mx-6 text-sm text-gray-600"
          >
            <h1>All Registered loan</h1>
            <router-link class="" :to="{ name: 'LoanRegisteration' }"
              >Register new loan</router-link
            >
          </div>
          <hr class="mt-1" />
          <div class="flex flex-col overflow-x-auto mt-5 mx-4">
            <div class="-my-2 sm:-mx-6 lg:-mx-8">
              <div
                class="
                  py-2
                  align-middle
                  inline-block
                  min-w-full
                  sm:px-6
                  lg:px-8
                "
              >
                <div
                  class="
                    shadow
                    overflow-hidden
                    border-b
                    bg-white
                    border-gray-200
                    sm:rounded-lg
                  "
                >
                  <LoansTable
                  :loansRegisters="loansRegisters.data"
                  :links="links"
                  :loanCounts="loanCounts"
                  @getForPage="getForPage"
                  @deleteUser="deleteUser"
                  />
                </div>
              </div>
            </div>
          </div>
          <pre>{{notification}}</pre>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import BreadCrum from "../components/BreadCrum.vue";
import { ref, computed, onMounted, watch } from "vue";
import { useStore } from "vuex";
import LoansTable from "../components/LoansTable.vue";

const store = useStore();
const notification = computed(() =>store.state.notify);


let Output = ref();

const links = computed(() => store.state.loan.links);

const loading = computed(() => store.state.loan.loading);
const loansRegisters = computed(() => store.state.loan.TotalRegistered);
const loanCounts = computed(() => store.state.loan.loanCounts);


// const input = ref(null);

const searchQuery = ref("");

store.dispatch("GetAllRegisteredLoan");
store.dispatch("getAllLoanCount");

 function getForPage(link) {
    if (!link.url || link.active) {
        return;
    }
    store.dispatch("GetAllRegisteredLoan", { url: link.url });
  }

  function deleteUser(id) {
    if (confirm('are you sure you want to delete this user')) {
      store.dispatch('deleteRegisteredLoansAccount', id).then((res) => {
        store.dispatch("GetAllRegisteredLoan");
        store.commit('notify', {
          type: 'success',
          message: 'This is user as been deleted sucessfully'
        })
      });
    }
}


function removeDropDown() {
  // Output.value = ''
}

// onMounted(() => {
//     input.value.focus();
// })
</script>

<style>
</style>