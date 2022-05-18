<template>
    <div class="w-full">
    <!-- <Header @ToggleSideBar="ToggleSideBar"/> -->
    <div class="my-0.5">
      <!-- breadcrum -->
      <div class="bg-white border border-gray-100 flex px-4 py-2 justify-between items-center text-indigo-500">
        <div class="flex space-x-2 items-center">
          <h1 class="tracking-wide font-medium text-xs text-indigo-500">Eagle wealth</h1> 
          <span class="las la-angle-right text-xs text-indigo-500"></span>
          <h1 class=" tracking-wide font-medium text-xs text-indigo-500"><router-link :to="{name: 'Dashboard'}">Dashboard</router-link></h1>
          <span class="las la-angle-right text-xs text-indigo-500"></span>
          <h1 class=" tracking-wide font-medium text-xs text-indigo-500">Messages</h1>
        </div>
        <div class="mr-5">
          <i class="las la-ellipsis-v"></i>
        </div>
      </div>
      <!-- breadcrum -->
      
    </div>
      
    </div>
</template>

<script setup>
import DashboardList from '../components/DashboardList.vue';
import { ref } from "vue";
import {computed} from 'vue';
import Header from '../components/Header.vue'
import store from '../store'
import ItemList from '../components/ItemList.vue'
import Analytic from '../components/Analytic.vue'
import Layer from '../components/Layer.vue'

const profile = ref(false);
const sideBar = ref(null);

// const date = new Date();

function toggleAccount() {
  profile.value = !profile.value;
}

// const developed = ref('Designed and developed by emmy britt');

// let show = computed(() => store.state.showBar);

function ToggleSideBar() {
  store.commit('ChangeStatus');
}



</script>

<style scoped>
  .sideNavbar{
    width: 25%;
  }
  @media screen and (max-width: 800px){
    .sideNavbar{
    width: 0;
  }
  }
</style>
