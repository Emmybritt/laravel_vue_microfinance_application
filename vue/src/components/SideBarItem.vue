<template>
  <div :class="[open ? 'sidebar-item open' : 'sidebar-item']" v-if="item.children">
      <div class="sidebar-title">
          <span :class="[show ? '' : 'border-b border-gray-500']">
              <i v-if="item.icon" :class="item.icon" class="text-2xl"></i>
              <span v-show="show">{{ item.name }}</span>
          </span>
          <i v-if="show" class="las la-chevron-down toggle-btn" @click="open = !open"></i>
      </div>
      <div class="sideBar-content">
      <ul class="pl-8 border-l">
         <li v-for="child in item.children" class="py-2" :key="child"><router-link :to="child.to" @click.prevent="">{{child.name}}</router-link></li>
      </ul>
      </div>
  </div>
  <div active-class="bg-slate-700" v-else class="sidebar-item">
      <router-link :to="item.to" class="sidebar-title plain">
          <span :class="[show ? '' : 'border-b border-gray-600']">
              <i class="text-2xl" :class="item.icon || '#'"></i>
              <span v-if="show">
                {{ item.name }}
            </span>
              
          </span>
      </router-link>
  </div>
</template>

<script setup>
import {ref, computed} from 'vue'
import {useStore} from 'vuex'

const store = useStore();
const open = ref(false);

const show = computed(() => store.state.showBar);

const props = defineProps({
    item: Object,
})



</script>

<style>
.sidebar-item{
    padding: .75em 1rem;
    color:white;
    display: block;
    transition: background-color .15s;
    /* border-bottom: 1px solid #fff; */
}
.sidebar-item:hover{
    background:rgba(22, 22, 22, .5)
}
.sidebar-title{
    display: flex;
    justify-content: space-between;
    /* font-size:1.2em; */
}
.sidebar-title span i{
    /* font-size: 1.5em; */
    display: inline-block;
    width: 1.5em;
}

.sidebar-title .toggle-btn{
    cursor: pointer;
}

.sidebar-item.open .sidebar-title .toggle-btn{
    transform: rotate(180deg);
    transition:transform .3s;
}

.sideBar-content{
    padding-top: .25em;
    height: 0;
    overflow: hidden;
}

.sidebar-item.open .sideBar-content{
    height: auto;
}

.sidebar-title .plain{
    color:white
}

</style>