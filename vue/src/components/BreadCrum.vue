<template>
  <div class="bg-white border border-gray-100 flex px-4 py-2 justify-between items-center text-indigo-500">
        <div class="flex space-x-2 items-center">
          <h1 class="tracking-wide font-medium text-xs text-indigo-500">Eagle wealth</h1> 
          <span class="las la-angle-right text-xs text-indigo-500"></span>
          <h1 class=" tracking-wide font-medium text-xs text-indigo-500">{{ title }}</h1>
        </div>
        <div class="mr-5">
          <i class="las la-ellipsis-v"></i>
        </div>
      </div>
</template>

<script setup>
    const props = defineProps({
        title: String,
    })
</script>

<style>

</style>