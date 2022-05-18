<template>
    <div>
        <!-- <div class="bg-slate-100" v-if="user.type === 'super_admin'">
      <div>
        
      </div>
      beginning
        <div class="flex">
            <div class=" hidden lg:block" :class="[show ? 'w-1/5': '']">
                <DashboardList :show="show"/>
            </div>
          
            
            <div class="grow" :class="[show ? 'w-4/5' : 'ml-16']">
              <div class="sticky top-0">
                <Header @ToggleSideBar="ToggleSideBar" :profile="profile"/>
              </div>
              <router-view></router-view>
            </div>
            
        
        </div>
        End
    </div> -->
        <!-- <div v-else-if="user.type === 'admin'">
      <div>Admin Dashboard</div>
      <pre>{{  user }}</pre>
    </div>
    <div v-else>
      <CustomerDashboard />
    </div> -->

        <!-- Main Gate here -->

        <div class="bg-slate-100" v-if="user.type !== 'customer'">
            <div></div>
            <!-- beginning -->
            <div class="flex">
                <div class="hidden lg:block" :class="[show ? 'w-1/5' : '']">
                    <DashboardList :show="show" />
                </div>

                <div class="grow" :class="[show ? 'w-4/5' : 'ml-16']">
                    <div class="sticky top-0">
                        <Header
                            @ToggleSideBar="ToggleSideBar"
                            :profile="profile"
                        />
                    </div>
                    <router-view></router-view>
        <!-- <pre>{{user}}</pre> -->

                </div>
            </div>
            
            <!-- End -->
        </div>

        <div v-else>
            <CustomerDashboard />
        </div>
        <!-- / End Of Main Gate Here -->
    </div>
</template>

<script setup>
import DashboardList from "../components/DashboardList.vue";
import Header from "../components/Header.vue";
import { ref } from "vue";
import { computed, watch } from "vue";
// import store from '../store'
import { useStore } from "vuex";
import ItemList from "../components/ItemList.vue";
import Analytic from "../components/Analytic.vue";
import Layer from "../components/Layer.vue";
import CustomerDashboard from "../components/CustomerDashboard/CustomerDashboard.vue";
import {useRoute} from 'vue-router'


const store = useStore();

const abilities = computed(() => store.state.rules);
// const abilities2 = computed(() => store.getters.ability);

const route = useRoute();

watch(route, (newVal, oldValue) => {
    store.dispatch("getUserRolePermission", store.state.user.data.role_id);
})


const show = computed(() => store.state.showBar);

const user = computed(() => store.state.user);
store.dispatch("getUser");

const profile = ref(false);
const sideBar = ref(null);

// const date = new Date();

function toggleAccount() {
    profile.value = !profile.value;
}

function ToggleSideBar() {
    store.commit("ChangeStatus");
}
</script>

<style scoped>
.sideNavbar {
    width: 25%;
}
@media screen and (max-width: 600px) {
    .sideNavbar {
        width: 40%;
        position: absolute;
        z-index: 50;
    }
}
</style>
