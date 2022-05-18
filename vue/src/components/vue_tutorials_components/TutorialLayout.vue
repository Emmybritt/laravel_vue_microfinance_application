<template>
  <div>
      <div class="flex space-x-3">
          <router-link :to="{name: 'AttributeBinding'}">Attribute binding</router-link>
          <router-link :to="{name: 'ConditionalLooping'}">Conditional Looping</router-link>
          <router-link :to="{name: 'HandlingUserInput'}">Handling user input</router-link>
          <router-link :to="{name: 'FormInputBinding'}">Form input binding</router-link>
          <router-link :to="{name: 'SortAndFilterList'}">Sort and filter</router-link>
          <router-link :to="{name: 'TreeItem'}">Tree item</router-link>
      </div>
      <router-view></router-view>
  </div>
</template>

<script setup>

</script>

<style>

</style>