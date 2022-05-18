<template>
  <div class="shadow-md antaliased ">
      <div class="grid md:grid-cols-4 px-8 py-3 lg:grid-cols-5 sm:grid-cols-3 grid-cols-2 border-b">
          <div>
              <h1 class="font-bold tracking-wider">About Eagle Wealth</h1>
              <router-link v-for="about in abouts" :to="about.to" :key="about" class="block text-sm py-1">{{ about.name }}</router-link>
          </div>
          <div>
               <h1 class="font-bold tracking-wider">Digital Services</h1>
              <router-link v-for="service in services" :to="service.to" :key="service" class="block text-sm py-1">{{ service.name }}</router-link>
          </div>
          <div>
               <h1 class="font-bold tracking-wider">Products</h1>
              <router-link v-for="product in products" :to="product.to" :key="product" class="block text-sm py-1">{{ product.name }}</router-link>
          </div>
          <div>
               <h1 class="font-bold tracking-wider">Quick Links</h1>
              <router-link v-for="quicklink in quicklinks" :to="quicklink.to" :key="quicklink" class="block text-sm py-1">{{ quicklink.name }}</router-link>
          </div>
          <div>
            <h1 class="font-bold tracking-wider">Connect</h1>
            <!-- <div class="flex justify-between space-x-1">
                <div class="bg-indigo-800 flex rounded-lg text-white px-2 py-2">
                    <span></span>
                    <p class="text-xs"><small>download on app store</small></p>
                </div>
                <div class="bg-indigo-800 flex rounded-lg text-white px-2 py-2">
                    <span></span>
                    <p class="text-xs"><small>download on google play</small></p>
                </div>
            </div> -->
          </div>
      </div>
      <div class="flex justify-center text-white text-sm py-2 border bg-indigo-700">
      @ 
      {{ date }} {{ firm }}
      <!-- © 2021 LAPO Microfinance Bank, Nigeria. -->
      </div>
  </div>
</template>

<script setup>
import {ref} from 'vue';

const date = new Date().getFullYear();
const firm = ref('Eagle Wealth Microfinance Bank, Nigeria');


const abouts = [
    {name: 'About US', to: {name: 'About'}},
    {name: 'Our Impact', to: {name: 'About'}},
]
const services = [
    {name: 'Mobile Banking', to: {name: 'About'}},
    {name: 'SME Online', to: {name: 'About'}},
    {name: 'Public Sector', to: {name: 'About'}},
]
const products = [
    {name: 'Short term loan', to: {name: 'About'}},
    {name: 'Educational Loan', to: {name: 'About'}},
    {name: 'Agricultural loan', to: {name: 'About'}},
    {name: 'My pikin savings', to: {name: 'About'}},
    {name: 'Regular savings', to: {name: 'About'}},
]
const quicklinks = [
    {name: 'Customer service', to: {name: 'About'}},
    {name: 'Privacy and policy', to: {name: 'About'}},
]

</script>

<style scoped>
    h1{
        margin-bottom: 10px;
    }
    p {
        /* font-size: */
    }
</style>