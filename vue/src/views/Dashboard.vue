<template>
    <div class="w-full h-screen">
    <!-- <Header @ToggleSideBar="ToggleSideBar" :profile="profile"/> -->
    <div class="my-0.5">
      <!-- breadcrum -->
      <BreadCrum title="Dashboard" />
      <!-- breadcrum -->
      <div class="px-6 mt-2">
        <Layer />
        <ItemList />
        <!-- <Analytic /> -->
      </div>
    </div>
    </div>
</template>

<script setup>
import DashboardList from '../components/DashboardList.vue';
import BreadCrum from '../components/BreadCrum.vue'
import { ref } from "vue";
import {computed} from 'vue';
import Header from '../components/Header.vue'
import store from '../store'
import ItemList from '../components/ItemList.vue'
import Analytic from '../components/Analytic.vue'
import Layer from '../components/Layer.vue'

const profile = ref(false);
const sideBar = ref(null);

const permission = computed(() => store.state.user.userPermission)

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

<style>
  .sideNavbar{
    width: 25%;
  }
  @media screen and (max-width: 800px){
    .sideNavbar{
    width: 0;
  }
  }
</style>
