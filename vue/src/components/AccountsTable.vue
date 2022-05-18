<template>
  <div>
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Account name
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Account number
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Phone number
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Holders address
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Registeration date
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 tracking-wider"
                >
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entry in data" :key="entry" class="divide-y">
                <td class="px-6 py-4 whitespace-nowrap border">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{ entry.account_name }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{ entry.account_number }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{ entry.phone_number }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{ entry.address }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{ entry.created_at }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap flex items-center">
                    <router-link :to="{name: 'AccountsView', params:{id: entry.id}}"
                        class=" text-indigo-500 hover:bg-indigo-500 p-1.5 hover:text-white focus:ring focus:ring-indigo-500 focus:ring-offset-2 inline-flex text-xs leading-5 rounded-full">
                        <i class="las la-eye text-lg"></i>
                    </router-link>
                    <button @click="deleteAccount(entry.id)" class="text-red-500 rounded-full hover:bg-red-300 hover:text-white focus:ring focus:ring-red-500 focus:ring-offset-2 px-1"><span class="las la-trash"></span></button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="m-3">
        <a 
            v-for="(link, i) of links" :key="i"
            :disabled="!link.url"
            href="#"
            @click.prevent="$emit('getForPage', link)"
            aria-current="page"
            v-html="link.label"
            :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',  i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '', i === links.length - 1 ? 'rounded-r-md' : '']"
            class="relative whitespace-nowrap font-medium text-xs inline-flex items-center px-4 py-2 border"
            ></a>
    </div>
    <div class="my-3 mb-4 flex justify-evenly divide-x text-gray-600">
        <div>
            <span class="font-medium text-sm">Daily Accounts</span>: 2790
        </div>
        <div>
            <span class="font-medium text-sm">Foodstuff Accounts</span>: 790
        </div>
        <div>
            <span class="font-medium text-sm">Total Accounts</span>: {{ accountCountLoading ? 'please wait...' : accountCounts }}
        </div>
    </div>
  </div>
</template>

<script setup>
import {ref, computed} from 'vue'
import {useStore} from 'vuex'

const store = useStore();

const accountCountLoading = ref(true);

const props = defineProps({
    data: Array,
    columns:Array,
    filterKey: String,
    links: Array,
})

store.dispatch("getAccountsCount").then(() => {
    accountCountLoading.value = false;
});

const accountCounts = computed(
    () => store.state.customers.customerCounts.accountsCount
);


function deleteAccount(id) {
    if (confirm('Are you sure you want to delete this account')) {
        store.dispatch("deleteAccount", id).then(() => {
        alert('account deleted successfully')
        store.dispatch('GetAllAccounts');
        })
    }
}



</script>

<style scoped>
    table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255, 255, 255, 0.66);
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