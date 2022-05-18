<template>
  <div>
    <div
      v-for="(guarantor, i) in guarantors"
      :key="i"
      class="space-y-3 divide-y mt-4"
    >
      {{ i + 1 }}
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Name:</h1>
        <span class="text-sm text-gray-600">{{ guarantor.full_name }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Age:</h1>
        <span class="text-sm text-gray-600">{{ guarantor.age }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Gender:</h1>
        <span class="text-sm text-gray-600">{{ guarantor.gender }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Phone number:</h1>
        <span class="text-sm text-gray-600">{{ guarantor.phone_no }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Nature of business:</h1>
        <span class="text-sm text-gray-600">{{
          guarantor.nature_of_business
        }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Address of business:</h1>
        <span class="text-sm text-gray-600">{{
          guarantor.address_of_business
        }}</span>
      </div>
      <div class="flex justify-between px-4">
        <h1 class="text-sm font-medium">Relationship:</h1>
        <span class="text-sm text-gray-600">{{ guarantor.relationship }}</span>
      </div>
    </div>
    <!-- <pre>{{ guarantors }}</pre> -->
  </div>
</template>

<script setup>
const props = defineProps({
  guarantors: Object,
});
</script>

<style>
</style>