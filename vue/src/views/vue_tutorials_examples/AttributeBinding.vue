<template>
  <div class="bg-gray-100 h-screen">
    <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Attribute Binding</div>
    <p><span :title="message">
        Hover Through me and you will see some reactions    
    </span></p>

    <p @click="toggleRed" :class="{red : isRed}">Click me and i will change color</p>


    <p @click="ToggleColor" :style="{color}">Click me and my color will be toggled</p>
  </div>
</template>

<script setup>
import {ref} from 'vue'

const message = ref('hello world');
const isRed = ref(true);
const color = ref('green');

function ToggleColor() {
    color.value = color.value === "green" ? 'blue' : 'green';
}

function toggleRed() {
    isRed.value = !isRed.value
}

</script>

<style>
.red {
    color:red;
}

</style>