<template>
    <div class="w-full min-h-screen">
        <div v-if="isReadPermited">
            <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
            <BreadCrum title="Positions" />
            <div
                style="background: rgba(0, 0, 0, 0.3)"
                class="absolute min-h-screen mx-auto max-w-lg flex justify-center items-center min-w-full top-0 left-0 right-0 bottom-0"
                v-if="RoleFormShouldShow"
            >
                <div class="bg-white shadow-md px-4 rounded py-3 w-[400px]">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold tracking-wide">
                            Create new role
                        </h1>
                        <span class="text-3xl cursor-pointer" @click="CancelAddRole"
                            >&times;</span
                        >
                    </div>
                    <div class="mt-4">
                        <form @submit.prevent="CreateRole">
                            <!-- <pre>{{notification}}</pre> -->
                            <div class="flex flex-col">
                                <label for="title" class="font-medium text-sm mt-2"
                                    >Role title</label
                                >
                                <input
                                    v-model="role.title"
                                    type="text"
                                    id="title"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="eg manager"
                                />
                            </div>
                            <div class="flex flex-col">
                                <label for="title" class="font-medium text-sm mt-2"
                                    >Role description</label
                                >
                                <textarea
                                    v-model="role.description"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="To protect the interest of smaaller branch"
                                ></textarea>
                                <!-- <input type="text" id="title"> -->
                            </div>
                            <div class="flex mt-5">
                                <a
                                    class="bg-red-500 cursor-pointer text-white px-5 py-3 rounded-full"
                                    @click="CancelAddRole"
                                    >Cancel</a
                                >
                                <button
                                    class="bg-green-500 text-white px-5 py-3 ml-3 rounded-full"
                                >
                                    {{ loading ? "please wait..." : "Submit" }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-white mt-3 mr-3">
                <div
                    v-if="notification.show"
                    :class="[
                        notification.type === 'success' ? 'bg-green-400' : 'bg-red-400',
                    ]"
                    class="absolute bottom-6 text-white px-3 py-2 rounded ml-4"
                >
                    {{ notification.message }}
                </div>
                <div class="px-6 py-3 ">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col md:flex-row">
                        <router-link
                            :to="{ name: 'Dashboard' }"
                            class="text-sm bg-gray-800 text-white rounded px-2 py-1"
                            ><span class="las la-angle-left"></span> Go
                            back</router-link
                        >
                        <button
                            v-if="isWritePermitted"
                            @click="AddNewPostion"
                            class="text-sm bg-green-500 text-white rounded px-2 py-1 md:ml-3"
                        >
                            <span class="las la-plus"></span> Add new position
                        </button>
                        <button
                            class="text-sm bg-red-500 text-white rounded px-2 py-1 md:ml-3"
                            @click="DeleteAllPositions"
                        >
                            <span class="las la-trash"></span> Delete all positions
                        </button>
                        </div>
                        <!-- <router-link :to="{name: 'PermisionsTable'}">Assign permission</router-link> -->
                    </div><hr class="mt-2">
                    
                    <div
                        v-if="roles.loading"
                        class="mt-4 flex flex-row text-green-800 justify-center items-center"
                    >
                        <img src="../../assets/Spinner-2.gif" class="w-5 h-5 mr-2" />
                        <p>Please wait while all roles are being fetched...</p>
                    </div>
                    <div class="tables pt-7" v-else>
                        <div class="flex flex-col overflow-x-auto">
                            <div class="-my-2 sm:-mx-6 lg:-mx-8">
                                <div
                                    class="py-2 align-middle inline-block sm:px-6 lg:px-8"
                                >
                                    <div
                                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                    >
                                        <table
                                            class="w-full divide-y divide-y-gray-200"
                                        >
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 font-medium capitalize tracking-wider"
                                                    >
                                                        s/n
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 font-medium capitalize tracking-wider"
                                                    >
                                                        title
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 font-medium capitalize tracking-wider"
                                                    >
                                                        Description
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 font-medium capitalize tracking-wider"
                                                    >
                                                        Permissions
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3 font-medium capitalize tracking-wider"
                                                    >
                                                        action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-gray-200"
                                            >
                                                <tr
                                                    v-for="(role, i) in roles.data.data"
                                                    :key="i"
                                                >
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-xs font-medium text-gray-700"
                                                            >
                                                                {{ i + 1 }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-700"
                                                            >
                                                                {{ role.title }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-700"
                                                            >
                                                                {{ role.description }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                        <div class="ml-4 grid grid-cols-3">
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                            <span class="text-xs text-white rounded mx-0.5 w-full bg-blue-400 px-3 block">user_management</span>
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap"
                                                    >
                                                    <span v-if="isDeletePermitted">
                                                        <button
                                                            @click="deleteRole(role.id)"
                                                            class="text-red-500 hover:bg-red-100 focus:border px-1 focus:border-red-500 rounded-full"
                                                        >
                                                            <span
                                                                class="las la-trash"
                                                            ></span>
                                                        </button>
                                                    </span>
                                                        <a
                                                            href="#"
                                                            class="ml-2 px-1 hover:bg-blue-100 focus:border focus:border-blue-500 rounded-full"
                                                            ><router-link :to="{name: 'PermisionsTable', params:{id: role.id}}"
                                                                class="las la-eye text-blue-500"
                                                            ></router-link
                                                        ></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div v-else>
            Permission not granted to access this page
        </div>
    </div>

</template>

<script setup>
import Header from "../../components/Header.vue";
import BreadCrum from "../../components/BreadCrum.vue";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";
import { ref, computed, onMounted } from "vue";
import { usePermission } from '../../permissions.js'
import {useAbility} from '@casl/vue'
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

const { isReadPermited, routeName, isRoute, isUserPermission, userPerm, isDeletePermitted, isWritePermitted } = usePermission();


const {can} = useAbility()


const store = useStore();
const router = useRouter();


store.dispatch("getRoles");

const loading = ref(false);

function ToggleSideBar() {
    store.commit("ChangeStatus");
}
const notification = computed(() => store.state.notification);
const roles = computed(() => store.state.roles);

const ShouldShowActions = ref(false);
const RoleFormShouldShow = ref(false);

const role = ref({
    title: "",
    description: "",
    permission: null
});

function CreateRole() {
    loading.value = true;
    store
        .dispatch("CreateRole", role.value)
        .then(({ data }) => {
            store.dispatch("getRoles");
            loading.value = false;
            store.commit("notify", {
                type: "success",
                message: "Roles was successfully created",
            });

            RoleFormShouldShow.value = false;
        })
        .catch((err) => {
            loading.value = false;
            store.commit("notify", {
                type: "fail",
                message:
                    "role creation was not successfull, look like this role already exist",
            });
        });
}

function AddNewPostion() {
    if (confirm("you want to create a new role")) {
        RoleFormShouldShow.value = !RoleFormShouldShow.value;
    }
}
function CancelAddRole() {
    RoleFormShouldShow.value = !RoleFormShouldShow.value;
}

function DeleteAllPositions() {
    if (
        confirm(
            "are you sure you want to delete all positions!!! this action can not be undone"
        )
    ) {
        store.dispatch("DeleteAllSurvey").then(({ data }) => {
            store.dispatch("getRoles");
            store.commit("notify", {
                type: "success",
                message: "All roles have been deleted successfully",
            });
        });
    }
}
// function ToggleAction() {
//     ShouldShowActions[0].value = !ShouldShowActions[0].value;
// }

function deleteRole(id) {
    if (
        confirm(
            "are you sure you want to delete this role, as this action cannot be undone"
        )
    ) {
        store.dispatch("DeleteRole", id);
    }
}

function EditRole() {
    alert("role edited succesfully");
}
</script>

<style scoped></style>
