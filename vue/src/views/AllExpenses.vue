<template>
    <div class="bg-slate-100 h-screen text-gray-700">
        <BreadCrum title="All expenses" />
        <!-- Searchable form -->
        <div class="px-6 py-2 bg-white my-2">
            <div class="flex flex-col md:flex-row">
                <button
                    onclick="history.back()"
                    class="text-sm bg-gray-800 text-white rounded px-2 py-1"
                >
                    <span class="las la-angle-left"></span> Go back
                </button>
                <router-link 
                class="text-sm 
                bg-emerald-600 ml-3 px-2 py-1 rounded text-white flex items-center" 
                :to="{name: 'Expenses'}"><span>add new expenses</span> <i class="las la-plus ml-1"></i></router-link>
            </div>
        </div>
        <div class="bg-white pb-3 px-3">
            <AllExpensesTable 
            :tableHead="table.tableHead"
            :expenses="totalExpense"
            :pagelinks="paginationLinks"
            @getForPage="getForPage"
            :loading="loading"
            :val="val"
            />
        </div>
        <!-- {{ () }} -->
    </div>
</template>

<script setup>
import BreadCrum from "../components/BreadCrum.vue";
import SearchedResult from "../components/SearchedResult.vue";
import AllExpensesTable from "../components/AllExpensesTable.vue";
import { ref, reactive, computed, onMounted, watch } from "vue";
import { useStore } from "vuex";

const store = useStore();

const searchField = ref("");
const SearchResultShouldShow = ref(false);
const loading = computed(() => store.state.expenses.loading);
const isSearching = ref(false);


const table = reactive({
    tableHead: [
        "Transaction date",
        "Service paid for",
        "Amount per quantity",
        "Total amount spent",
        "created day",
        "action",
    ],
});

function getForPage(link) {
    if (!link.url || link.active) {
        return;
    }
    store.dispatch("getAllExpenses", {url: link.url})
}

const totalExpense = computed(() => store.state.expenses.AllExpenses);
const paginationLinks = computed(() => store.state.expenses.totalExpensesLinks);

// let val = ref();

// watch(() => store.state.expenses.totalExpenses, (newVal, oldVal) => {
//     val.value = newVal;
// })
const val = computed(() => store.state.expenses.totalExpenses);

onMounted(() => {
    store.dispatch("getAllExpenses");
    store.dispatch("GetExpensesBalance");

});
</script>

<style></style>
