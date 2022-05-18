
<template>
  <div class="bg-gray-100">
      <Banner />
      <div class="bg-white shadow-lg mb-3 p-12 md:px-24">
        <div class="md:w-2/3">
          <h1 class="text-2xl font-medium mb-3">Smart funding for your future</h1>
          <p class="text-left text-sm">We provide a wide array of direct-lending solutions, both group and individual, plus specialized lending products such as asset-based lending.</p>
        </div>
      </div>
      <div class="bg-image py-8 px-5 pl-12 mb-3">
        <h1 class="text-white tracking-wider nunito mb-3 text-4xl font-bold">Our History</h1>
        <p class="text-white mb-4">Discover our past, present, and future — the evolution of our brand and the place we have in Nigeria Banking world.</p>
        <router-link :to="{name: 'About'}" class="text-white bg-pink-600 px-4 py-3 rounded-md font-medium hover:bg-pink-700 hover:ring-1 
        hover:ring-pink-700 hover:ring-offset-1">Read about us</router-link>
      </div>
  </div>
</template>

<script setup>
  import Banner from '../components/Banner.vue'
</script>

<style>
  .bg-image{
    background-image: url('../assets/bgimage.jfif');
    background-size: cover;
  }
</style>