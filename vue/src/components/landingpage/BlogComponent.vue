<template>
  <div>
        <h1 class="text-3xl font-bold my-3 text-gray-600 text-center">Recent updates</h1>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 py-2 px-4">
          <router-link :to="{name: 'SingleBlog', query:{title: 'How to pass my exams'}}">
        <div class="flex flex-col group hover:bg-sky-500 group-hover:opacity-90 hover:ring-sky-500 bg-white rounded-lg shadow-md">
          <div>
            <img src="../../assets/photograph_img3.jpg" class="h-32 w-full" alt="">
          </div>
          <div class="text-gray-600 px-3 py-2">
            <h1 class="font-medium text-gray-700 group-hover:text-white">How to run a successfull bussiness</h1>
          <p class="leading-snug text-xs group-hover:text-white">To become a successful bussiness man you need to work hard....</p>
          </div>
          <div class="flex items-center py-2 px-2">
            <div class="flex w-1/2 items-center px-2">
              <span class="text-xs text-gray-500 group-hover:text-white">Finance</span>
              <span class="text-xs text-gray-500 group-hover:text-white ml-2">1 day ago</span>
            </div>
            
            <div class="w-1/2 flex items-center justify-between">
              <span><i class="lar la-heart cursor-pointer group-hover:text-white"></i></span>
              <span><i class="las la-share cursor-pointer group-hover:text-white"></i></span>
              <span><i class="las la-ellipsis-v cursor-pointer group-hover:text-white"></i></span>
            </div>
          </div>
        </div>
        </router-link>
      </div>
      </div>
</template>

<script setup>

</script>

<style>

</style>