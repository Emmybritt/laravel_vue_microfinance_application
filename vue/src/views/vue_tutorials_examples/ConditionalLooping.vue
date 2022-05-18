<template>
  <div class="bg-gray-100 h-screen">
    <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Conditional Looping</div>
    <div class="mx-auto max-w-lg bg-white shadow-md mt-4 px-3 py-2">
      <button @click="show = !show" type="button" class=" rounded-lg bg-indigo-200 text-indigo-500 m-2 px-2 ring ring-indigo-400 focus:ring-offset-2">toggle list</button>
      <button @click="lists.push(lists.length + 1)" type="button" class=" rounded-lg bg-purple-200 text-purple-500 m-2 ring px-2 ring-purple-400 focus:ring-offset-2">Push number</button>
      <button @click="lists.pop" type="button" class=" rounded-lg bg-yellow-200 text-yellow-500 m-2 ring px-2 ring-yellow-400 focus:ring-offset-2">Pop number</button>
      <button @click="lists.reverse" type="button" class=" rounded-lg bg-emerald-200 text-emerald-500 m-2 ring px-2 ring-emerald-400 focus:ring-offset-2">reverse list</button>
      <ul v-if="show && lists.length">
        <li v-for="list of lists" :key="list">{{list}}</li>
        
      </ul>
      <p v-if="lists.length">List is not empty but hidden</p>
        <p v-else>List is empty</p>
    </div>
  </div>
</template>

<script setup>
import {ref} from 'vue';

const show = ref(true);

const lists = ref([1,2,3]);

</script>

<style>

</style>