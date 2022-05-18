<template>
  <div class="bg-gray-100 h-screen">
    <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Sort And filter</div>
    <div class="mx-auto max-w-lg bg-white shadow-md mt-4 px-3 py-2">
        <form id="search" class="flex my-3">
            Search <input type="text" name="query" v-model="searchQuery" class="w-full outline-none border px-3 py-1.5 rounded-md focus:ring focus:ring-indigo-300 focus:ring-offset-2">
        </form>
            <DemoGrid
            :data="gridData"
            :columns="gridColumns"
            :filter-key="searchQuery"
            />
    </div>
  </div>
</template>

<script setup>
import DemoGrid from '../../components/vue_tutorials_components/DemoGrid.vue'
import {ref} from 'vue'

const searchQuery = ref('');

const gridColumns = ['name', 'power']
const gridData = [
  { name: 'Chuck Norris', power: Infinity },
  { name: 'Bruce Lee', power: 9000 },
  { name: 'Jackie Chan', power: 7000 },
  { name: 'Jet Li', power: 8000 }
]
</script>

<style>

</style>