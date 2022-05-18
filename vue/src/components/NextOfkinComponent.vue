<template>
  <div class="space-y-3 divide-y mt-4">
    <div class="flex justify-between px-4">
      <h1 class="text-sm font-medium">Name:</h1>
      <span class="text-sm text-gray-600">{{ nextOfKin.name }}</span>
    </div>
    <div class="flex justify-between px-4">
      <h1 class="text-sm font-medium">Relationship:</h1>
      <span class="text-sm text-gray-600">{{ nextOfKin.relationship }}</span>
    </div>
    <div class="flex justify-between px-4">
      <h1 class="text-sm font-medium">phone number:</h1>
      <span class="text-sm text-gray-600">{{ nextOfKin.phone_no }}</span>
    </div>
    <div class="flex justify-between px-4">
      <h1 class="text-sm font-medium">Address:</h1>
      <span class="text-sm text-gray-600">{{ nextOfKin.address }}</span>
    </div>
    <!-- <pre>{{ nextOfKin }}</pre> -->
  </div>
</template>

<script setup>
const props = defineProps({
  nextOfKin: Object,
});
</script>

<style>
</style>