<template>
  <div class="bg-gray-100 h-screen">
    <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Form input binding</div>
    <div class="mx-auto max-w-lg max-h-md bg-white shadow-md mt-4 px-3 py-2 my-auto">
        <h1 class="text-2xl text-center font-bold tracking-wider mt-2">Text Input</h1>
        <br>
        <input @keyup.enter="alert(text)" type="text" v-model="text"
         class="outline-none border border-indigo-200 px-3 py-1 font-medium mx-3 focus:ring focus:ring-indigo-100 focus:ring-offset-2 rounded-lg">{{ text }}

         <h1 class="text-2xl text-center font-bold tracking-wider mt-2">Checkbox</h1>
         <input type="checkbox" name="checkbox" id="checkbox" v-model="checked"> checked: {{ checked }}
        <br>
    </div>
  </div>
</template>

<script setup>
import {ref} from 'vue';

const text = ref('Edit me and see');
const checked = ref(true);


</script>

<style>

</style>