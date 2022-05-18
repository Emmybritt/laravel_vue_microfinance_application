<template>
    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-6 gap-4"
    >
        <!-- <pre>{{accountCounts}}</pre> -->
        <div
            v-for="(layout, i) in layouts"
            :key="i"
            class="bg-white px-3 py-2 rounded drop-shadow-sm"
        >
            <div class="flex justify-between">
                <h2 class="text-blue-500 uppercase text-sm md:font-medium">
                    {{ layout.bonus }}
                </h2>
                <h2 class="font-bold text-indigo-600">{{ layout.title }}</h2>
            </div>
            <h1
                class="text-right text-xl tracking-wider md:font-medium text-blue-500 py-3"
            >
                <!-- <img v-show="!layout.value"  src="../assets/Spinner-2.gif" class="h-6 w-6 float-right" alt=""> -->
                <span>
                    {{ layout.value }}
                </span>
            </h1>
            <div class="justify-between mb-2 relative">
                <span class="bg-indigo-600 text-white rounded-sm p-2"
                    ><i :class="layout.icon"></i
                ></span>
                <span
                    class="text-xs bg-indigo-50 float-right text-indigo-800 px-2 py-1 rounded relative bottom-0"
                    ><router-link :to="layout.to">{{
                        layout.action
                    }}</router-link></span
                >
            </div>
        </div>
        <!-- <pre>{{loanCounts}}</pre> -->
    </div>

    <!-- <div>
        <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+29.0.8 %</h2>
              <h2 class="font-bold text-indigo-600">Total customers</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">2,348,994</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-indigo-700 text-white rounded-sm p-2"><i class="las la-users text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">view all customers</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-pink-500 uppercase text-sm md:font-medium">-0.560 %</h2>
              <h2 class="font-bold text-indigo-600">Payments</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">9,994</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-blue-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">View all orders</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+10.560 %</h2>
              <h2 class="font-bold text-indigo-600">Total Earnings</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">9,994</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-purple-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">See details</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+10.560 %</h2>
              <h2 class="font-bold text-indigo-600">Expenses</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">9,120</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-purple-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">See details</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+10.560 %</h2>
              <h2 class="font-bold text-indigo-600">Total branches</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">3,000</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-purple-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">View All branch</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+10.560 %</h2>
              <h2 class="font-bold text-indigo-600">Total workers</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">30</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-purple-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">See details</a></span>
          </div>
      </div>
      <div class="bg-white px-3 py-2 rounded drop-shadow-sm">
          <div class="flex justify-between">
              <h2 class="text-blue-500 uppercase text-sm md:font-medium">+10.560 %</h2>
              <h2 class="font-bold text-indigo-600">Positions</h2>
          </div>
          <h1 class="text-right text-xl tracking-wider text-blue-500 md:font-medium py-3">9,120</h1>
          <div class=" justify-between mb-2 relative">
              <span class="bg-purple-700 text-white rounded-sm p-2"><i class="las la-user-circle text-xl"></i></span>
              <span class="text-xs text-pink-500 float-right relative bottom-0"><a href="" class="underline">View All Positions</a></span>
          </div>
      </div>
    </div> -->
</template>

<script setup>
import store from "../store";
import { computed, onMounted, ref } from "vue";

let msg = ref("");



onMounted(() => {
    msg.value = "it has been mounted";
});
const loanCounts = computed(() => store.state.loan.totalLoansCounts);
const rolesCount = computed(() => store.state.roles.roleCounts.counts);
const branchesCount = computed(
    () => store.state.branches.branchCounts.branches
);
const staffCounts = computed(() => store.state.staffs.staffCounts.staffsCount);
const accountCounts = computed(
    () => store.state.customers.customerCounts.accountsCount
);
const Expenses = computed(() => store.state.expenses.totalExpenses);


store.dispatch("getBranchesCount");
store.dispatch("getAllTotalLoanCount");
store.dispatch("getRolesCount");
store.dispatch("getStaffCounts");
store.dispatch("getAccountsCount");
store.dispatch("GetExpensesBalance");

const layouts = [
    {
        title: "Total balance",
        bonus: "1.2",
        icon: "las la-chart-line text-xl",
        value: "165.89k",
        to: { name: "TotalBalance" },
        action: "view balance",
    },
    {
        title: "Total accounts",
        bonus: "+2",
        icon: "las la-users text-xl",
        value: accountCounts,
        to: { name: "TotalCustomers" },
        action: "view all customer",
    },
    {
        title: "Messages",
        bonus: "+2",
        icon: "las la-envelope-open text-xl",
        value: "99",
        to: { name: "TotalMessages" },
        action: "view messages",
    },
    {
        title: "Total Loan",
        bonus: "+3",
        icon: "las la-donate text-xl",
        value: loanCounts,
        to: { name: "LoansViews" },
        action: "view all loans",
    },
    {
        title: "Expenses",
        bonus: "+56",
        icon: "las la-wallet text-xl",
        value: Expenses,
        to: { name: "Expenses" },
        action: "view all expenses",
    },
    {
        title: "Total branches",
        bonus: "+3",
        icon: "las la-sitemap text-xl",
        value: branchesCount,
        to: { name: "TotalBranches" },
        action: "view all branches",
    },
    {
        title: "Total staffs",
        bonus: "+7",
        icon: "las la-ribbon text-xl",
        value: staffCounts,
        to: { name: "TotalWorkers" },
        action: "view all workers",
    },
    {
        title: "Total roles",
        bonus: "+0",
        icon: "las la-certificate text-xl",
        value: rolesCount,
        to: { name: "Positions" },
        action: "view all positions",
    },
];

onMounted(() => {
    // console.log(Expenses.);
})
</script>

<style></style>
