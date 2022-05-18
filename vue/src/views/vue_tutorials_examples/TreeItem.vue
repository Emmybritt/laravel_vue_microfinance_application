<template>
  <div class="bg-gray-100 h-screen">
    <div class="bg-gray-700 text-white py-3 font-bold text-2xl tracking-wider w-full text-center">Sort And filter</div>
    <div class="mx-auto max-w-lg bg-white shadow-md mt-4 px-3 py-2">
        <tree-component class="item" :model="treeData" />
    </div>
  </div>
</template>

<script setup>
import {ref} from 'vue'
import TreeComponent from '../../components/vue_tutorials_components/TreeComponent.vue'

const treeData = ref({
  name: 'My Tree',
  children: [
    { name: 'hello' },
    { name: 'world' },
    {
      name: 'child folder',
      children: [
        {
          name: 'child folder',
          children: [{ name: 'hello' }, { name: 'world' }]
        },
        { name: 'hello' },
        { name: 'world' },
        {
          name: 'child folder',
          children: [{ name: 'hello' }, { name: 'world' }]
        }
      ]
    }
  ]
})
</script>


<style scoped>
.item {
  cursor: pointer;
  line-height: 1.5;
}
.bold {
  font-weight: bold;
}
</style>