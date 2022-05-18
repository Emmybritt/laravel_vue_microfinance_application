<template>
  <div class="border-b bg " >
     <div style="background-color: rgba(0, 0, 0, 0.6);" class="md:flex p-4 py-24 space-y-10">
       <div class="md:w-2/3 flex flex-col justify-center">
         <h1 class="font-bold text-4xl md:text-5xl antialiased font-seriff text-left text-white tracking-wider">Eagle wealth building scheme</h1>
         <p class="text-2xl nunito text-left mt-3 text-white">Looking to save for something special</p>
         <div class="flex mt-4 justify-center">
           <button class="bg-pink-600 text-white rounded-md px-5 py-3 text-lg font-medium hover:text-white hover:border hover:bg-pink-800">Explore</button>
           <button class="px-5 py-3 text-lg border border-pink-500 rounded-md text-white font-medium ml-2 hover:bg-pink-600 hover:text-white">Create Account</button>
         </div>
       </div>
       <div class="md:w-1/3 drop-shadow-md">
         <div class="rounded-lg">
           <div class="bg-white rounded-t-lg">
             <h1 class="text-center font-bold text-2xl text-gray-900 py-2">Customers xperience</h1>
           </div>
           <div style="background-color: rgba(0, 0, 0, 0.6);">
             <ul class="text-white divide-y divide-dashed px-3 py-2">
               <li v-for="item in items" :key="item" class="px-4 py-0.5 text">{{item}}</li>
             </ul>
           </div>
         </div>
       </div>
     </div>
  </div>
</template>

<script setup>
const items = ['Soft loan', 'mobile banking', 'Long term loan', 'short term loan']
    
</script>

<style>
  .bg{
    background-image: url('../assets/banner.jpg');
    background-size: cover;
  }
  .text{
    font-size: 1rem;
  }
  
</style>