<template>
  <div class="md:flex mt-2 md:space-x-4">
      <div class="md:w-2/3 bg-white shadow-md">
          <div class="flex justify-between px-3 border-b py-2">
                <h1 class="text-xs text-indigo-600 font-medium">Today's Report</h1>
                <h1 class="text-xs bg-green-600 text-white px-3 py-1 rounded-sm">view your clients</h1>
          </div>
          <div class="">
             <ClientsTableComponent />
          </div>
      </div>
      <div class="md:w-1/3 bg-white shadow-md">
          <div class="flex justify-between  border-b px-3 py-2">
            <h1 class="text-indigo-600 font-medium text-xs">messages</h1>
            <h1 class="text-white bg-green-600 px-3 rounded-sm py-1 text-xs"><a href="#">read all messages</a></h1>
          </div>
          <div>
            <MessagesList />
          </div>
      </div>
  </div>
</template>

<script setup>
import ClientsTableComponent from './ClientsTableComponent.vue'
import MessagesList from './MessagesList.vue';
</script>

<style>

</style>