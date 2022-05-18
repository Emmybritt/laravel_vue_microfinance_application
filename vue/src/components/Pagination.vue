<template>
  <div>
      <a href="" :disabled="!link.url"></a>
  </div>
</template>

<script setup>
    const props = defineProps(['link'])
</script>

<style>

</style>