<template>
  <div>
      <header>
          <div class="bg-slate-800 px-2 py-2">
          <div class=" text-gray-100">
              <h1 v-if="title" class="text-center tracking-wider text-xl font-bold">
                  {{ title }}
              </h1>
          </div>
      </div>
      </header>
      <main>
          <div>
              <slot></slot>
          </div>
      </main>
  </div>
</template>

<script setup>
const props = defineProps({
    title: String,
})

</script>

<style>

</style>