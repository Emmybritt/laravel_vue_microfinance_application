<template>
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
                    <tbody v-if="searchedResult">
                        <tr v-for="acc in searchedResult" :key="acc" class="divide-y w-full text-sm text-gray-700">
                            <td>{{acc.account_name}}</td>
                            <td>{{acc.account_number}}</td>
                            <td>{{acc.phone_number}}</td>
                            <td>{{acc.address}}</td>
                            <td class="text-xs">{{moment(acc.created_at).format('MMMM Do YYYY, h:mm:ss a')}}</td>
                            <td>
                                <div class="flex items-center">
                                    <span @click="$emit('Deleteaccount', acc.id)" 
                                    class="las la-trash text-red-600 rounded-full bg-red-100 hover:bg-red-600 hover:text-white  p-1"></span>
                                    <span class="bg-green-100 text-gray-600 text-xs hover:text-green-700 font-medium ml-1 px-2 rounded py-2">
                                        <router-link :to="{name: 'AccountsView', params:{id: acc.id} }"><span>view profile</span></router-link>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <pre>{{searchedResult}}</pre> -->
    </div>
  </div>
</template>

<script setup>
import moment from 'moment'
const props = defineProps({
    searchedResult: Object,
    tableHead: Array,
})

const emit = defineEmits(['Deleteaccount']);

</script>

<style>

</style>