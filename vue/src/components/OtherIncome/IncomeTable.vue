<template>
  <div>
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-white tracking-wider"
                >
                    Income type
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-white tracking-wider"
                >
                    Amount
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-white tracking-wider"
                >
                    created_at
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-white tracking-wider"
                >
                    Last updated
                </th>
                <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-white tracking-wider"
                >
                    More
                </th>
            </tr>
        </thead>
        <tbody v-if="recentIncome.recent_income">
            <tr v-for="income in recentIncome.recent_income.data" :key="income.id" class="divide-y divide-x">
                <td class="px-6 py-4 whitespace-nowrap border">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{income.incomeType}}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{income.amount}}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{moment(income.created_at).format('MMMM Do YYYY h:mm:ss a')}}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 text-black inline-flex text-xs leading-5 rounded-full">
                        {{moment(income.updated_at).format('MMMM Do YYYY h:mm:ss a')}}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <button class="bg-pink-500 text-white rounded text-xs focus:outline focus:outline-offset-2 focus:outline-pink-300 px-2 py-1">remove</button>
                    <button class="bg-indigo-500 text-white ml-2 rounded text-xs focus:outline focus:outline-offset-2 focus:outline-indigo-300 px-2 py-1">edit</button>
                </td>
            </tr>
        </tbody>
      </table>
      <!-- <pre>{{ recentIncome.recent_income.data }}</pre> -->
  </div>
</template>

<script setup>
import moment from 'moment';
const props = defineProps({
    recentIncome:Object,
})

</script>

<style>

</style>