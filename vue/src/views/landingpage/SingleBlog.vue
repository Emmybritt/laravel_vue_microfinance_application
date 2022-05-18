<template>
  <div>
      Single blog
  </div>
</template>

<script setup>
import {useRoute} from 'vue-router';

const route = useRoute();

if (route.query.title) {
    console.log(route.query.title);
}


</script>

<style>

</style>