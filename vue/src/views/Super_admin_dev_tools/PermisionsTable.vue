<template>
<div class="bg-slate-100 h-screen text-gray-700">
    <BreadCrum title="Role management" />
    <div class="bg-white p-4 mt-4 mr-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
              <h1 class="font-medium">Edit Role permission</h1>
              <!-- <select v-model="id" class="border outline-none ml-4 rounded-md w-[300px] px-2 py-1 text-sm" @change="changeAdmin" placeholder="Select role">
                  <option value="" disabled>{{roles.role.length ? 'Select role type' : 'Fetching all roles...'}}</option>
                  <option v-for="(r,i) in roles.role" :key="i" :value="r.title">{{r.title}}</option>
              </select> -->
            </div>
            <div>
              <router-link :to="{name: 'Positions'}">Create new role</router-link>
            </div>
        </div><hr class="mt-2">
        <div class="mt-7">
          <h1 v-if="role" class="text-lg font-medium mb-3">{{role.title}}</h1><hr class="mt-1">
          <vSelect multiple v-model="RolePermissions.data" :options="permissions" placeholder="Select permission for this role"></vSelect>
          <!-- <pre>{{RolePermissions}}</pre> -->
          <div>
            <button @click.prevent="SubmitPermission" :disabled="IsloadingStatus" :class="[IsloadingStatus ? 'bg-emerald-300' : '']" class="bg-emerald-500 mt-3 px-5 w-lg rounded-md py-2 text-white">
              {{ IsloadingStatus ? 'Saving permissions...' : 'Save' }}
            </button>
          </div>
          <div v-if="notification.show" class="bg-emerald-500 text-white mt-3 py-2 px-3">
            {{ notification.message }}
          </div>
        
        </div>
        </div>

</div>
</template>

<script setup>
import BreadCrum from "../../components/BreadCrum.vue";
import { ref, reactive, computed, onMounted, watch } from "vue";
import { useStore } from "vuex";
import { usePermission } from '../../permissions.js'
import {useRoute} from 'vue-router'
import vSelect from 'vue-select'

const store = useStore();

const route = useRoute();
const IsloadingStatus = ref(false);
const RolePermissions = reactive({
  data: [],
});

const notification = computed(() => store.state.notification);

const role = computed(() => store.state.roles.singleRole);

const sss = computed(() => Object.values(store.state.rolesPermission.data));

watch(() => store.state.rolesPermission.data, (newVal, oldVal) => {
  RolePermissions.data = JSON.parse(JSON.stringify(newVal))
  // console.log(typeof JSON.parse(JSON.stringify(newVal)));

});

if (route.params.id) {
  store.dispatch("getsingleRole", route.params.id)
  store.dispatch("getRolePermission", route.params.id)
}



const permissions = reactive([
  'create_account',
  'delete_account',
  'update_account',
  'access_account',
  'view_account',
  'create_loan',
  'delete_loan',
  'update_loan',
  'access_loan',
  'view_loan',
  'create_marketers_payin',
  'delete_marketers_payin',
  'update_marketers_payin',
  'access_marketers_payin',
  'view_marketers_payin',
  'view_other_income',
  'create_other_income',
  'delete_other_income',
  'update_other_income',
  'access_other_income',
  'view_transactions',
  'create_transactions',
  'delete_transactions',
  'update_transactions',
  'access_transactions',
  'view_expenses',
  'create_expenses',
  'delete_expenses',
  'update_expenses',
  'access_expenses',
  'create_role',
  'delete_role',
  'update_role',
  'access_role_management',
  'view_role_management',
]);

function SubmitPermission() {
  IsloadingStatus.value = true;
  store.dispatch('assignPermission', {
    value: RolePermissions, 
    id:route.params.id
  }).then((res) => {
    store.commit("notify", {
      message: "Permission successfully granted to this role",
      type: 'success'
    })
    store.dispatch("getRolePermission", route.params.id)
    IsloadingStatus.value = false;
  }).catch(err => {
    IsloadingStatus.value = false;
  })
  // console.log(RolePermissions.value);
}



const { isReadPermited, routeName, isRoute, isUserPermission, userPerm, isDeletePermitted, isWritePermitted } = usePermission();

onMounted(() => {
    // console.log(routeName)
    // console.log(isRoute)
    // console.log(isUserPermission);
    // console.log(userPerm);isReadPermited
    // isReadPermited
})




let id = ref(null);
const roles = reactive({
  role: []
});
const isLoading = ref(false)

watch(
  () => store.state.roles.data.data,
  (newVal, oldVal) => {
    roles.role = newVal
    // console.log(newVal);
  }
);


const resources = reactive({ 
  res: [
    {resourceName: 'Accounts', read: false, write: false, update: false, delete: false, name: 'accounts'},
    {resourceName: 'Messages', read: false, write: false, update: false, delete: false, name: 'messages'},
    {resourceName: 'Dashboard', read: false, write: false, update: false, delete: false, name: 'dashboard'},
    {resourceName: 'Accounts', read: false, write: false, update: false, delete: false, name: 'total-customers'},
    {resourceName: 'Positions', read: false, write: false, update: false, delete: false, name: 'Positions'},
  ]
})

let DefaultresourcesPermission = reactive({ 
  res: [
    {resourceName: 'Accounts', read: false, write: false, update: false, delete: false, name: 'accounts'},
    {resourceName: 'Messages', read: false, write: false, update: false, delete: false, name: 'messages'},
    {resourceName: 'Dashboard', read: false, write: false, update: false, delete: false, name: 'dashboard'},
    {resourceName: 'Accounts', read: false, write: false, update: false, delete: false, name: 'total-customers'},
    {resourceName: 'Positions', read: false, write: false, update: false, delete: false, name: 'Positions'},
  ]
})

let num = '';




function changeAdmin(){
  const result = reactive({resu: JSON.parse(JSON.stringify(roles.role))});
  let index = result.resu.findIndex((role) => role.title == id.value);
  let permission = ref(result.resu[index].permission)

   let num_i = result.resu.filter((ad) => ad.title == id.value).map(e => e.id);
    num = parseInt(num_i);
  console.log(num);

    // console.log(JSON.parse(JSON.stringify(permission)));
  if (!permission.value) {
    resources.res = DefaultresourcesPermission.res;
  }else{
    resources.res = JSON.parse(permission.value);
  }
}

function AssignRoles() {
  let data = JSON.stringify(resources.res);
  isLoading.value = true;
  store.dispatch("UpdateRolesPermission", {data, num}).then(() => {
    alert('Permission has been granted successfully')
    isLoading.value = false;
    store.dispatch('getRoles')
  })
}


store.dispatch('getRoles')

</script>

<style>

</style>