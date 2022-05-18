<template>
  <div>
      <Header />
      <router-view v-slot="{Component, route }">
        <transition :name="route.meta.transition || 'fade'">
          <component :is="Component"></component>
        </transition>
      </router-view>
      <Footer class="relative bottom-0 mt-3 border bg-indigo-100 pt-4" />
  </div>
</template>

<script setup>
import Header from './Header.vue'
import Footer from './Footer.vue'

</script>

<style>

</style>