<template>
    <div class="h-screen">
        <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
        <BreadCrum title="branches" />

        <div class="px-6 py-3 bg-white my-2">
            <div class="flex flex-col md:flex-row">
                <button onclick="history.back()" class="text-sm bg-gray-800 text-white rounded px-2 py-1"><span class="las la-angle-left"></span> Go back</button>
                <button
                    @click="AddNewBranch"
                    class="text-sm bg-green-500 text-white rounded px-2 py-1 md:ml-3"
                >
                    <span class="las la-plus"></span> Add new branch
                </button>
                <button
                    class="text-sm bg-red-500 text-white rounded px-2 py-1 md:ml-3"
                    @click="DeleteAllBranches"
                >
                    <span class="las la-trash"></span> Delete all branches
                </button>
            </div>
        </div>
        <div
            style="background: rgba(0, 0, 0, 0.7)"
            class="absolute min-h-screen mx-auto max-w-lg flex justify-center items-center min-w-full top-0 left-0 right-0 bottom-0"
            v-if="BranchFormShouldShow"
        >
            <div class="bg-white shadow-md px-4 rounded py-3 w-[400px]">
                <div class="flex justify-between">
                    <h1 class="text-2xl font-bold tracking-wide">
                        Create new branch
                    </h1>
                    <span
                        class="text-3xl cursor-pointer"
                        @click="CancelAddBranch"
                        >&times;</span
                    >
                </div>
                <div class="mt-4">
                    <form @submit.prevent="CreateBranch">
                        <!-- <pre>{{notification}}</pre> -->
                        <div class="flex flex-col">
                            <label for="title" class="font-medium text-sm mt-2"
                                >Branch unique number</label
                            >
                            <input
                                v-model="branch.branch_number"
                                type="text"
                                id="title"
                                class="w-full uppercase outline-none border-indigo-500 border-b text-sm py-2"
                                placeholder="e.g (USELU-1)"
                            />
                        </div>
                        <div class="flex flex-col">
                            <label for="title" class="font-medium text-sm mt-2"
                                >Branch name</label
                            >
                            <input
                                v-model="branch.branch_name"
                                required
                                type="text"
                                id="title"
                                class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                placeholder="Give a name to the branch for ref purpose"
                            />
                        </div>
                        <div class="flex flex-col">
                            <label for="title" class="font-medium text-sm mt-2"
                                >Branch Full address</label
                            >
                            <textarea
                            required
                                v-model="branch.branch_address"
                                class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                placeholder="7 mission street okeibujeun benin state"
                            ></textarea>
                            <!-- <input type="text" id="title"> -->
                        </div>
                        <div class="flex flex-col">
                            <label for="title" class="font-medium text-sm mt-2"
                                >Branch Co-ordinator/manager</label
                            >
                            <input
                                v-model="branch.co_ordinator"
                                type="text"
                                id="title"
                                class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                placeholder="eg Emmy britt"
                            />
                        </div>
                        <div class="flex mt-5">
                            <a
                                class="bg-red-500 cursor-pointer text-white px-5 py-3 rounded-full focus:outline-red-500 focus:outline-offset-2"
                                @click="CancelAddBranch"
                                >Cancel</a
                            >
                            <button
                                class="bg-green-500 text-white px-5 py-3 ml-3 rounded-full focus:outline focus:outline-green-500 focus:outline-offset-2"
                            >
                                {{ loading ? "please wait..." : "Submit" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Branches List -->
        <div class="bg-white px-3 py-3">
            <div v-if="branches.loading" class="mt-4 mx-4 text-center flex text-sm text-gray-600">
                <img src="../../assets/Spinner-2.gif" class="h-5 w-5 mr-1" alt="">
                <p>Please wait while we fetch all branches...</p>
                </div>
            <div v-else class="flex flex-col overflow-x-auto">
                <!-- <pre>{{ branches }}</pre> -->
                <div class="-my-2 sm:-mx-6 lg:-mx-8">
                    <div
                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                    >
                        <div
                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                        >
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            s/n
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            Branches name
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            Branches id
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            Branches location
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            created date
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            branch co-ordinator
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium capitalize tracking-wider"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr v-for="(branch, i) in branches.data.data" :key="branch.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-900">
                                                {{ i + 1 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-900">
                                                {{ branch.branch_name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-100 text-green-800"
                                            >
                                                {{ branch.branch_number }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ branch.branch_address }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ branch.created_at }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            {{ branch.co_ordinator }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                        >
                                            <span @click="DeleteBranch(branch.id)" class="las la-trash text-red-600 rounded-full bg-red-100 hover:bg-red-600 hover:text-white  p-1"></span>
                                            <span class="las la-edit text-blue-600 bg-blue-100 hover:bg-blue-600 hover:text-white ml-1 rounded-full p-1"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Branches List -->
         <div v-if="notification.show" :class="[notification.type === 'success' ? 'bg-green-600' : 'bg-red-500']" class=" absolute bottom-6 text-white px-3 py-2 rounded ml-4">{{ notification.message }}</div>
    </div>
</template>

<script setup>
import Header from "../../components/Header.vue";
import BreadCrum from "../../components/BreadCrum.vue";
import { useStore } from "vuex";
import { ref, computed } from "vue";
import moment from 'moment'
const store = useStore();

const loading = ref(false);
const branches = computed(() => store.state.branches);

const BranchFormShouldShow = ref(false);
const notification = computed(() => store.state.notification);

store.dispatch('GetAllBranches');


const branch = ref({
    branch_number: "",
    branch_name: "",
    branch_address: "",
    co_ordinator: "",
});

function ToggleSideBar() {
    store.commit("ChangeStatus");
}

function DeleteAllBranches() {
    if (confirm("Are you sure you want to delete all branch")) {
        store.dispatch('DeleteAllBranches').then(({data}) => {
            store.dispatch('GetAllBranches');
            store.commit('notify', {
            type: 'success',
            message: 'All Branches have been deleted successfully'
        }) 
        })
    }
}
function AddNewBranch() {
    BranchFormShouldShow.value = !BranchFormShouldShow.value;
}

function DeleteBranch(id){
    if (confirm('Are you sure you want to delete this branch, as operation cannot be undone???')) {
        store.dispatch('DeleteBranch', id)
    }
}

function CancelAddBranch() {
    BranchFormShouldShow.value = !BranchFormShouldShow.value;
    loading.value = false;
}
function CreateBranch() {
    loading.value = true;

    store
        .dispatch("CreateBranch", branch.value)
        .then(({ data }) => {
            store.dispatch('GetAllBranches');
            loading.value = false;
            BranchFormShouldShow.value = false;
            store.commit("notify", {
                type: "success",
                message: "Branch was successfully created",
            });
        })
        .catch((err) => {
            loading.value = false;
        });
}
</script>

<style scoped></style>
