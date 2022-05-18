<template>
    <div class="w-full">
        <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
        <BreadCrum title="staffs" />
        <div class="bg-white shadow-md mt-4 mr-3">
            <div class="px-6 py-3">
                <div class="flex flex-col md:flex-row">
                    <router-link
                        :to="{ name: 'Dashboard' }"
                        class="text-sm bg-gray-800 text-white rounded px-2 py-1"
                        ><span class="las la-angle-left"></span> Go
                        back</router-link
                    >
                    <button
                        @click="AddNewStaff"
                        class="text-sm bg-green-500 text-white rounded px-2 py-1 md:ml-3"
                    >
                        <span class="las la-plus"></span> Add new staff
                    </button>
                    <button
                        class="text-sm bg-red-500 text-white rounded px-2 py-1 md:ml-3"
                        @click="DeleteAllstaffs"
                    >
                        <span class="las la-trash"></span> Delete all staffs
                    </button>
                </div>
            </div><hr class="mt-2 mb-3">
            <div
                style="background: rgba(0, 0, 0, 0.7)"
                class="absolute min-h-screen mx-auto max-w-lg flex justify-center items-center min-w-full top-0 left-0 right-0 bottom-0"
                v-if="StaffFormShouldShow"
            >
                <div class="bg-white shadow-md px-4 rounded py-3 w-[800px]">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold tracking-wide">
                            Create new staff
                        </h1>
                        <span
                            class="text-3xl cursor-pointer"
                            @click="CancelAddStaff"
                            >&times;</span
                        >
                    </div>
                    <pre>{{notification}}</pre>
                    <div class="mt-4">
                        <img class="w-sm" v-if="staff.image_url" :src="staff.image_url" alt="">
                        <form @submit.prevent="CreateStaff">

                            <!-- <pre>{{ErrorMsg}}</pre> -->
                            <div v-if="ErrorMsg" class="bg-red-500 justify-between text-xs flex rounded px-4 py-2 text-white">
                                <div >
                                    <ul>
                                        <li v-for="(msg, i) in ErrorMsg.full_name" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.branch_number" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.other_name" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.email" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.role" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.role_id" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.role_id" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.phone_number" :key="i">{{msg}}</li>
                                        <li v-for="(msg, i) in ErrorMsg.password" :key="i">{{msg}}</li>
                                    </ul>
                                </div>
                                <div>
                                <span @click="ErrorMsg = null" class="bg-red-600 cursor-pointer text-xl rounded-full px-2">&times;</span>
                                </div>
                            </div>
                            <!-- {{ staff }} -->
                            <!-- Fullname -->
                            <div class="md:flex">
                                <div class="md:w-1/2">
                                    <div class="flex flex-col">
                                    <label for="name" class="font-medium text-sm mt-2"
                                        >Staff Fullname</label
                                    >
                                    <input
                                        v-model="staff.full_name"
                                        type="text"
                                        id="name"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                        placeholder="e.g (Ogwu emmanuel berit)"
                                    />
                                    </div>
                                    <!--/ Fullname -->
                                <!-- Other name -->
                                <div class="flex flex-col">
                                    <label for="other_name" class="font-medium text-sm mt-2"
                                        >Staff Other names</label
                                    >
                                    <input
                                        v-model="staff.other_name"
                                        type="text"
                                        id="other_name"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                        placeholder="e.g (Emmy britt)"
                                    />
                                </div>
                                <!--/ Other name -->
                                <!-- pasport photograph -->
                                <div class="flex flex-col">
                                    <label for="image" class="font-medium text-sm mt-2"
                                        >Staff passport photograph</label
                                    >
                                    <input
                                        @change="onImageChoose"
                                        type="file"
                                        id="image"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    />
                                </div>
                                <!--/ pasport photograph -->
                                <!-- Staff Role -->
                                <div class="flex w-full">
                                    <div class="flex w-full flex-col">
                                    <!-- <input type="hidden" v-model="role.id"> -->
                                    <label for="image" class="font-medium text-sm mt-2"
                                        >Staff role</label
                                    >
                                    <select v-model="staff.role" class="w-full outline-none border-indigo-500 border-b text-sm py-2">
                                        <option value="" disabled>{{Roles.data ? 'Please select a role'  : 'fetching current roles...'}}</option>
                                        <option v-for="(role, i) in Roles.data" :key="role.id" :value="role.title"> {{ i + 1}}, {{role.title}}</option>
                                    </select>
                                    
                                </div>
                                    <div class="flex w-full flex-col">
                                    <!-- <input type="hidden" v-model="role.id"> -->
                                    <label for="image" class="font-medium text-sm mt-2"
                                        >Confirm role</label
                                    >
                                    <select v-model="staff.role_id" class="w-full outline-none border-indigo-500 border-b text-sm py-2">
                                        <option value="" disabled>{{Roles.data ? 'Please select a role'  : 'fetching current roles...'}}</option>
                                        <option v-for="(role, i) in Roles.data" :key="role.id" :value="role.id"> {{ i + 1}}, {{role.title}}</option>
                                    </select>
                                    
                                </div>

                                </div>
                                
                                <!--/ Staff Role -->
                                <!-- Staff Email address -->
                                <div class="flex flex-col">
                                    <label for="email" class="font-medium text-sm mt-2"
                                        >Staff Email address</label
                                    >
                                    <input
                                        v-model="staff.email"
                                        type="email"
                                        id="email"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    />
                                </div>
                                <!--/ Staff Email address -->
                                </div>


                                <div class="md:w-1/2 md:ml-3">
                                    
                                <!-- Staff phone number -->
                                <div class="flex flex-col">
                                    <label for="phone_number" class="font-medium text-sm mt-2"
                                        >Staff Phone number</label
                                    >
                                    <input
                                        v-model="staff.phone_number"
                                        type="tel"
                                        id="phone_number"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    />
                                </div>
                                <!--/ Staff phone number -->
                                <!--/ Staff Home address -->

                                <div class="flex flex-col">
                                    <label for="title" class="font-medium text-sm mt-2"
                                        >Staff Home address</label
                                    >
                                    <input type="text"
                                    required
                                        v-model="staff.address"
                                        class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                        placeholder="7 mission street okeibujeun benin state"
                                    >
                                    <!-- <input type="text" id="title"> -->
                                </div>
                                <!--/ Staff Home address -->
                                <!--/ Staff Branch -->
                                <div class="flex flex-col">
                                    <label for="name" class="font-medium text-sm mt-2"
                                        >Staff Branch</label
                                    >
                                    <select v-model="staff.branch_number" class="w-full outline-none border-indigo-500 border-b text-sm py-2" @change="getRoleTitle">
                                        <option value="" disabled>{{branches.data ? 'Please select a branch number' : 'fetching current branches...'}}</option>
                                        <option v-for="branch in branches.data" :value="branch.branch_number" :key="branch.id">{{branch.branch_number}}</option>
                                    </select>
                                </div>
                                <!--/Staff Branch -->
                                <!-- Staff Password -->
                                <div class="flex flex-col">
                                <label for="password" class="font-medium text-sm mt-2"
                                    >Staff password</label
                                >
                                <input
                                    v-model="staff.password"
                                    type="password"
                                    id="password"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                />
                                </div>
                                <!-- /Staff password -->
                                <!-- Staff confirm Password -->
                                <div class="flex flex-col">
                                <label for="password_confirmation" class="font-medium text-sm mt-2"
                                    >confirm password</label
                                >
                                <input
                                    v-model="staff.password_confirmation"
                                    type="password"
                                    id="password_confirmation"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                />
                                </div>
                                <!-- /Staff confirm password -->
                                </div>
                            
                            </div>
                            <div class="flex mt-5">
                                    <button type="button"
                                        class="bg-red-500 cursor-pointer text-white px-5 py-3 rounded-full focus:outline focus:outline-red-500 focus:outline-offset-2"
                                        @click="CancelAddStaff"
                                        >{{ cancelLoading ? 'cancelling...' : 'cancel'}}</button
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
            <!-- Staff List -->
            <div>
            <div v-if="staffs.loading" class="mt-4 mx-4 text-center flex items-center" >
                <img src="../../assets/Spinner-2.gif" alt="" class="h-5 w-5">
                <p>Please wait while we fetch all staffs...</p>
            </div>
                <div v-else class="flex flex-col overflow-x-auto w-[1080px]">
                    <div class="-my-2 sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                        >
                            <div
                                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                            >
                                <table class="divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Staff name
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Phone number
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Staff role
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Branch number
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Staff address
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Registeration date
                                            </th>
                                            <th
                                                scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium tracking-wider"
                                            >
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200"
                                    >
                    <!-- <pre>{{ staffs.staffs }}</pre> -->
                                        <tr v-for="staff in staffs.data.staffs" :key="staff.id">
                                            
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"  alt="" />
                                                </div>
                                                <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-900">
                                                {{ staff.name }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ staff.email }}
                                                </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-100 text-green-800"
                                                >
                                                    {{ staff.number }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ staff.role }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ staff.branch_id ? staff.branch_id : 'NIL' }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ staff.address }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ staff.created_at }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                <span @click="DeleteStaff(staff.id)" class="las la-trash text-red-600 rounded-full bg-red-100 hover:bg-red-600 hover:text-white  p-1"></span>
                                                <span class="las la-edit text-blue-600 bg-blue-100 hover:bg-blue-600 hover:text-white ml-1 rounded-full p-1"></span>
                                                <router-link :to="{name: 'StaffProfile', params: {id: staff.id}}" class="bg-green-500 text-white text-xs hover:text-white ml-1 px-2 rounded-full p-1"><a href="">view profile <i class="las la-link"></i></a></router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Staff list -->
        </div>
                <!-- <pre>{{Roles}}</pre> -->

    </div>
</template>

<script setup>
    import Header from '../../components/Header.vue'
    import BreadCrum from '../../components/BreadCrum.vue'
    import {useStore} from 'vuex';
    import {ref, computed, watch, reactive, onMounted} from 'vue';

    const StaffFormShouldShow = ref(false);
    
    const staffs = computed(() => store.state.staffs);
    let ErrorMsg = ref([]);

    const store = useStore();
    const loading = ref(false);
    const cancelLoading = ref(false); 

    const branches = computed(() => store.state.branches.data);
    const Roles = computed(() => store.state.roles.data);
    const notification = computed(() => store.state.notify);
    let roles = reactive({
                    data: null
                })
    onMounted(() => {
        roles.data = Roles
    })



    store.dispatch("GetAllStaffs");


    const staff = ref({
        full_name: '',
        other_name: '',
        role_id: null,
        image: '',
        role: '',
        email: '',
        phone_number: '',
        address: '',
        branch_number: '',
        image_url: '',
        password: '',
        password_confirmation: ''
    })

    watch(() => staff.value.role_id, (newVal) => {
        const stit = Object.values(roles.data).find((r) => r.id = newVal);
        // const tile = stit.map((t) => t.title);
        staff.value.role
        // console.log(stit.title)
    })

  

    function CreateStaff(){
        loading.value = true;
        store.dispatch("createStaff", staff.value)
        .then(({data}) => {
            store.dispatch("GetAllStaffs");
            loading.value = false;
            store.commit("notify", {
                type: 'success',
                message: "The staff was successfully created"
            });
            StaffFormShouldShow.value = false;
            // staff.value = null;
        }).catch(err => {
            ErrorMsg.value = err.response.data.errors
            loading.value = false;
        })
    }

    function AddNewStaff() {
        StaffFormShouldShow.value = !StaffFormShouldShow.value
        store.dispatch('GetAllBranches');
        store.dispatch('getRoles');
    }

    function CancelAddStaff() {
        cancelLoading.value = true;
        setTimeout(() => {
            StaffFormShouldShow.value = !StaffFormShouldShow.value
            cancelLoading.value = false;
        }, 1000)
    }
    
    function ToggleSideBar() {
    store.commit("ChangeStatus");
 }

//  const staffs = computed(() => store.state.staffs);

function DeleteStaff(id) {
    if (confirm('are you sure you want to delete this staff')) {
        store.dispatch('deleteStaff', id).then(() => {
            store.dispatch("GetAllStaffs");
            store.commit("notify", {
                type: 'success',
                message: "The staff was successfully deleted"
            });
        })
    }
}

    function DeleteAllstaffs(){
        if (confirm('are you sure you want to delete all staffs')) {
            
        }
    }

    function onImageChoose(ev) {
        const file = ev.target.files[0];

        const reader = new FileReader();

        reader.onload = () => {
            staff.value.image = reader.result;
            staff.value.image_url = reader.result;
            ev.target.value = "";
        };
        reader.readAsDataURL(file);
    }
</script>

<style scoped></style>
