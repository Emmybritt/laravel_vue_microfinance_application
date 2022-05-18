<template>
  <div>
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
        <tbody>
            <tr v-for="exp in searchedExpenses.result" :key="exp" class="divide-y w-full text-sm text-gray-700">
                <td>{{exp.trans_date}}</td>
                <td>{{exp.service_paid_for}}</td>
                <td>{{exp.amount_per_quantity}}</td>
                <td>{{exp.total_amount_spent}}</td>
                <td>{{exp.created_at}}</td>
                <td class="flex items-center">
                    <router-link 
                    class="text-xs text-white  px-2 mx-1 py-1 rounded bg-emerald-500"
                    :to="{name: 'ViewExpenses', params: {id: exp.id}}">view</router-link>
                    <div class="text-xs text-white  px-2 mx-1 py-1 rounded bg-red-500"><button @click="$emit('deleteExpenses', exp.id)"><i class="las la-trash"></i></button></div>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</template>

<script setup>
const props = defineProps({
    tableHead:Array,
    searchedExpenses: Object,
})

const emit = defineEmits(['deleteExpenses'])

</script>

<style>

</style>