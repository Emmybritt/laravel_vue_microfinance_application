<template>
    <div class="bg-gray-100 h-screen">
        <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Handling user input</div>
        <div class="m-6 text-lg font-medium">
            {{ message }} 
            <button 
            @click="ReverseMsg"
            class="bg-orange-600 text-white font-medium text-lg ring ring-orange-200 focus:ring-offset-2 rounded-lg ml-6 px-3 py-1">Reverse message</button>
            <button @click="message += '!'" class="bg-indigo-600 text-white font-medium text-lg ring ring-indigo-200 focus:ring-offset-2 rounded-lg ml-6 px-3 py-1">Append "!"</button>
            <button @click="message -= '!'" class="bg-sky-600 text-white font-medium text-lg ring ring-sky-200 focus:ring-offset-2 rounded-lg ml-6 px-3 py-1">remove "!"</button>
            {{ another }}
            {{ anothers }}

        </div>
        <a href="www.google.com" @click.prevent="notify">Click this link</a>
    </div>
</template>

<script setup>
import {ref} from 'vue'

const message = ref('Hello bro how are you doing today');

const anothers = ref('');

const another = ref('')

function ReverseMsg() {
    message.value = message.value.split("").reverse().join("");
    another.value = message.value.split(" ")[0].toUpperCase();
    anothers.value = message.value.slice(1, 2).toUpperCase();
}

function notify() {
    alert('please you cannot click this')
}

</script>

<style>

</style>