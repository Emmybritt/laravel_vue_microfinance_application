<template>
  <div class="shadow-md flex justify-between px-4 py-4 bg-white ">
        <div class="flex items-center">
          <span v-if="showBar" class="cursor-pointer"  @click="ToggleSideBar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 
            1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          </span>
          <span class="cursor-pointer" @click="ToggleSideBar" v-else>
            <svg xmlns="http://www.w3.org/2000/svg" 
            class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" 
            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
          </svg>
          </span>
          <!-- Search field -->
          <div class="shadow-sm px-4 rounded hidden md:flex items-center ml-3 bg-white">
            <div v-if="user.role == 'super_admin'">
              <router-link :to="{name: 'SuperAdminTool'}" class="text-sm bg-gradient-to-br from-indigo-600 via-pink-600 bg-clip-text text-transparent to-gray-700">Resource controller</router-link>
            </div>
            <div v-else-if="!user">
              <span class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" 
                  class="h-5 w-5" fill="none" viewBox="0 0 24 24" 
                  stroke="currentColor">
                  <path stroke-linecap="round" 
                  stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </span>
              <input type="text" placeholder="Search..." class="outline-none ml-2 py-2">
            </div>
            <div v-else>
              <router-link :to="{name: 'SuperAdminTool'}" class="text-sm bg-gradient-to-br from-indigo-600 via-pink-600 bg-clip-text text-transparent to-gray-700">Resource controller</router-link>
            </div>
          </div>
          <!--/ Search field -->
        </div>

        <div class="flex cursor-pointer items-center space-x-4">
          <span>
            <span class="absolute top-3 ml-3 bg-red-500 text-white text-xs px-1 rounded-full">5</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" 
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" 
            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
          </svg>
          </span>
          <router-link :to="{name: 'Notification'}">
            <span class="absolute top-3 ml-3 bg-red-500 text-white text-xs px-1 rounded-full"><span v-if="totalNotification">{{totalNotification.notification_count}}</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" 
          class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 
          6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        </router-link>
    <!-- Avatar field -->
    <div class="flex items-center" @click="toggleAccount">
    
    <!-- <img src="" v-if="image"/> -->
    <div class="rounded-full shadow-sm p-1">
        
        <svg xmlns="http://www.w3.org/2000/svg" 
        class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" 
stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
    </div>
    </div>
    <!--/ Avatar Field -->
    <div class="flex flex-col">
      <h1 class="text-sm text-slate-800 ml-2 mr-1 flex items-center font-medium">{{ user.other_name }}</h1>
      <p class="text-xs text-gray-700">{{user.role}}</p>
    </div>
    
    <div class="absolute top-16 bg-indigo-800 rounded border w-32" v-show="profile">
    <ul class="text-white text-sm divide-y divide-orange-50">
        <li class="w-full px-3 py-1 hover:bg-indigo-900"><a href="">Profile</a></li>
        <li class="w-full px-3 py-1 hover:bg-indigo-900"><a href="" >Settings</a></li>
        <li class="w-full px-3 py-1 hover:bg-indigo-900"><a href="" >Logout</a></li>
    </ul>
    </div>
</div>
  <!-- <pre>{{totalNotification.notification_count}}</pre> -->
    </div>
</template>

<script setup>
import { useStore } from "vuex";
import { computed, ref, watch } from 'vue';

const store = useStore();
const emit = defineEmits(['ToggleSideBar']);
const props = defineProps({
  profile:Boolean,
})

const totalNotification = ref(null)

watch(() => store.state.notification.notificationCount, (newVal, oldVal) => {
  totalNotification.value = newVal;
})

// function FirstCase(str) {
//   return str.charAt(0).toUpperCase() + str.slice(1);
// }


    function ToggleSideBar() {
        emit('ToggleSideBar');
    }

    store.dispatch('getNotificationCounts');

const showBar = computed(() => store.state.showBar);

const user = computed(() => store.state.user.data);
    
</script>

<style>

</style>