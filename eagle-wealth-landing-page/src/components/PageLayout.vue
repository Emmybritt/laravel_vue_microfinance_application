<template>
  <div>
      <Header />
      <router-view></router-view>
      <Footer class="relative bottom-0 mt-3 border bg-indigo-100 pt-4" />
  </div>
</template>

<script setup>
import Header from './Header.vue'
import Footer from '../components/Footer.vue'

</script>

<style>

</style>