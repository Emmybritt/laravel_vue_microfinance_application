<template>
    <div class="bg-slate-800 z-100" :class="[show ? 'sideBar' : 'toGGledSidebar']">
        <div class="flex space-x-2 items-center py-4 px-3 bg-slate-900">
            <div>
              <img src="../assets/eaglewealthlogo.jfif" alt="" class="h-8 w-8 rounded-full ">
            </div>
            <h1 class="text-white tracking-widest font-medium text-xl font-seriff" :class="[show ? 'inline' : 'hidden']">Eagle wealth</h1>
          </div> 
      <SideBar />
    </div>
</template>

<script setup>
    import { useStore } from 'vuex'
    import { computed, ref } from 'vue'
    import SideBar from './SideBar.vue'
    // import store from '../store'

   const store = useStore();
   const shouldShow = ref(true);
   const isOpen = ref(false);

   const show = computed(() => store.state.showBar);



function toggle() {
  isOpen.value = !isOpen.value
}


   const isChildren = computed(() => {
   });

   function ShowClass(list, i) {
            console.log()
            
    //    shouldShow.value
       toggled.value = !toggled.value;
   }

   const props = defineProps({
       show: Boolean,
   });

   

    
</script>

<style scoped>
body{
  color:white;
}
.sideBar{
  width:260px;
  flex-shrink:0;
  height:100vh;
  /* background: red; */
  overflow: auto;
  position:fixed;
  top:0;
}
.toGGledSidebar{
  width:60px;
  flex-shrink:0;
  height:100vh;
  /* background: red; */
  overflow: auto;
  position:fixed;
  top:0;
}

</style>