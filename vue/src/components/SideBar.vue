<template>
  <div>
    <SideBarItem v-for="(item, i) in sideNavLists" :key="i" :item="item" />
    <button class="text-white ml-6" @click="logout">Logout</button>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import SideBarItem from "./SideBarItem.vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const router = useRouter();

const store = useStore();

const abilities = computed(() => store.state.rules);

const sideNavLists = ref([
  {
    name: "Dashboard",
    to: { name: "Dashboard" },
    icon: "lab la-accusoft",
  },
  {
    name: "Accounting",
    icon: "lab la-buffer",
    gate: abilities[4],
    children: [
      { name: "Create Account", to: { name: "TotalCustomers" } },
      { name: "View Account", to: { name: "AccountView" } },
    ],
  },
  {
    name: "Loan Management",
    icon: "lab la-gitter",
    gate: abilities[6],
    children: [
      { name: "Loan Registeration", to: { name: "LoanRegisteration" } },
      { name: "Loan Payment", to: { name: "LoanPayment" } },
      { name: "Loan masterall", to: { name: "LoansViews" } },
    ],
  },
  {
    name: "marketers pay In",
    icon: "lab la-gitter",
    gate: abilities[26],
    children: [
      { name: "Add pay In", to: { name: "MarketersPayin" } },
      { name: "Total pay In`s", to: { name: "TotalMarketersPayin" } },
    ],
  },
  {
    name: "Other Income",
    to: { name: "OtherIncome" },
    icon: "las la-won-sign",
  },
  {
    name: "Transactions",
    to: { name: "Transactions" },
    icon: "las la-wallet",
  },
  {
    name: "All Expenses",
    to: { name: "Expenses" },
    icon: "las la-shopping-cart",
  },
  
  {
    name: "Role management",
    to: { name: "Positions" },
    icon: "lar la-comments",
  },
  {
    name: "Blog",
    to: { name: "BlogUpload" },
    icon: "lar la-comments",
  },
  {
    name: "my Profile",
    icon: "las la-cog",
    children: [
      {
        name: "Settings",
        to: { name: "Settings" },
      },
      {
        name: "Logout",
        to: "",
      },
    ],
  },
]);

function logout() {
  store.dispatch("logout").then(() => {
    router.push({
      name: "Login",
    });
  });
}
</script>

<style>
</style>