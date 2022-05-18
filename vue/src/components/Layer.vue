<template>
  <div class="md:flex space-x-4 justify-between">
    <div class="md:flex md:items-center hidden">
        <span class="bg-indigo-700 rounded-sm px-2 py-1 mr-2 text-white"><i class="lab la-centos animate-spin text-2xl"></i></span>
        <span class="bg-white shadow-md rounded text-sm  px-2 py-2 mr-3 flex items-center">
            <router-link v-if="abilities['create_account']" :to="{name: 'AccountView', }">Create new account </router-link>
            <i class="las la-plus-circle text-lg ml-2"></i>
        </span>
        <span class="flex items-center">
        <i class="lar la-calendar bg-indigo-700 text-2xl  px-2 py-2 text-white rounded-l-md"></i>
        <span class="rounded-r-md bg-white shadow-md text-sm px-2 py-2">{{moment().format('MMMM Do YYYY h:mm:ss a')}}</span>
        </span>
    </div>
    <div class="hidden lg:block">
        <h3 class="text-right font-medium text-gray-600">
            <span v-if="time < 12 ">Good morning🙋‍♂️🙋‍♂️🙋‍♂️🎀 {{user.other_name}}! I hope you had a wonderful night</span>
            <span v-else-if="time >= 12 && time < 17">Good Afternoon!!!😎😄 {{user.other_name}}, Hope your day is going well</span>
            <span v-else-if="day === 7">Happy sunday {{user.other_name}},</span>
            <span v-else>Have a lovely night my darling {{user.other_name}}!!!😁😍🤩</span>  
            
        </h3>
        <span class="text-right text-sm" v-if="time < 12 ">Here's what's happening with your dashboard today</span>
        <span class="text-right text-sm" v-else-if="time >= 12 && time < 17">Ihope your day is not being too stressed out</span>  
        <span v-else-if="day === 7">Ensure that you go to church today</span>
        <span class="text-right text-sm" v-else-if="day === 5">Todays is friday everybody like it la la la!!! 🎆🎇</span>
        <span class="text-right text-sm" v-else>Sleep quick so you can wake up for tomorrows work</span> 
    </div>
    <!-- <pre>{{abilities[0]}}</pre> -->
    </div>
</template>

<script setup>
import { useStore } from "vuex";
import { computed } from 'vue';
import moment from "moment";
import {useAbility} from '@casl/vue'
const store = useStore();
const user = computed(() => store.state.user.data);

const abilities = computed(() => store.state.rules);

const {can} = useAbility()

const time = new Date().getHours();
const day = new Date().getDay();
</script>

<style>

</style>