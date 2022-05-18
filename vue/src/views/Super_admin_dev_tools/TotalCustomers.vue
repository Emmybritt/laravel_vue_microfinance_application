<template>
    <div class="h-screen">
        <!-- <Header @ToggleSideBar="ToggleSideBar" /> -->
        <BreadCrum title="accounts" />
        <div class="px-6 py-2 flex justify-between items-center bg-white mt-2">
            <div class="flex flex-col md:flex-row">
                <router-link
                    :to="{ name: 'Dashboard' }"
                    class="text-sm bg-gray-800 text-white rounded px-2 py-1"
                    ><span class="las la-angle-left"></span> Go
                    back</router-link
                >
                <button
                    @click="AddNewCustomer"
                    class="text-sm bg-green-500 text-white rounded px-2 py-1 md:ml-3"
                >
                    <span class="las la-plus"></span> Create new accounts
                </button>
                <button
                    class="text-sm bg-red-500 text-white rounded px-2 py-1 md:ml-3"
                    @click="DeleteAllCustomer"
                >
                    <span class="las la-trash"></span> remove all caccounts
                </button>
            </div>
            <div class="md:inline hidden bg-indigo-100 text-sm rounded px-2 py-2">
                <router-link :to="{name: 'AccountView'}" class="text-indigo-600  font-medium">View all accounts here <span class="las la-external-link-alt"></span></router-link>
            </div>
        </div>
        <!-- Notification Starts here -->
        <div class="relative" v-if="notification.show">
            <div class="bg-emerald-500 absolute right-7 max-w-lg px-3 py-2 text-white">
                {{ notification.message }}
            </div>
        </div>
        <!-- Notification Starts here -->

        <!-- Searchable form -->
        <div class="bg-white my-2 p-3">
            <form class="flex">
                <div class="w-3/4">
                    <input type="search" v-model="searchField" placeholder="Enter any keyword to search for an expenses..." class="px-5 w-full rounded-full py-3 outline-none border focus:ring-gray-300 border-gray-200">
                </div>
                <button :disabled="isSearching" class="bg-green-600 w-1/4 rounded-full py-2 text-white ml-3 focus:ring focus:ring-offset-2 focus:ring-green-300" @click.prevent="SearchAccountInfo">{{isSearching ? 'Searching for accounts...' : 'Search Now'}}</button>
            </form>
            <div v-if="SearchResultShouldShow"><hr class="mt-3">
                <p v-if="isSearching" class="flex"><img src="../../assets/Spinner-2.gif" class="h-5 w-5 mr-1" alt=""> Fetching Results...</p>
                <p v-else-if="!Object.keys(searchedResult).length" class="flex">Oops!!! searched result not found!!!</p>
                <div v-else>
                    <AccountSearchedResult :searchedResult="searchedResult" :tableHead="tableHead" @Deleteaccount="Deleteaccount"/>
                </div>
            </div>
        </div>
    <!-- End of searchable form -->


        <!-- Add new customer form -->
        <Teleport to="body">
            <Transition name="fade" duration="550">
        <div
            style="background: rgba(0, 0, 0, 0.5)"
            class="absolute h-screen mx-auto max-w-lg flex justify-center items-center min-w-full top-0 left-0 right-0 bottom-0"
            v-if="ClientsFormShouldShow"
        >
            <div class="bg-white shadow-md px-4 rounded py-3 w-[800px]">
                <div class="flex justify-between">
                    <h1 class="text-2xl inline border-b border-indigo-300 font-bold tracking-wide">
                        Create new account
                    </h1>
                    <!-- <pre>{{account}}</pre> -->
                    <span
                        class="text-3xl cursor-pointer"
                        @click="CancelAddClient"
                        >&times;</span
                    >
                </div>
                <div class="mt-4">
                    <img class="h-48 w-48" v-if="account.image_url" :src="account.image_url" alt="">
                    <form @submit.prevent="Createaccount">
                        <!-- <pre>{{errorMsg}}</pre> -->
                        <!-- Fullname -->
                        <div class="md:flex">
                            <div class="md:w-1/2">
                                <div class="flex flex-col">
                                <label for="name" class="font-medium text-sm mt-2"
                                    >Account owner fullname</label
                                >
                                <input
                                    v-model="account.account_name"
                                    type="text"
                                    id="name"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="e.g (Ogwu emmanuel berit)"
                                />
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.account_name" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                                </div>
                                 <!--/ Fullname -->
                            <!-- Other name -->
                            <div class="flex flex-col">
                                <label for="other_name" class="font-medium text-sm mt-2"
                                    >Other names/Nickname</label
                                >
                                <input
                                    v-model="account.other_name"
                                    type="text"
                                    id="other_name"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="e.g (Emmy britt)"
                                />
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.other_name" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            </div>
                            <!--/ Other name -->
                            <!-- pasport photograph -->
                            <div class="flex flex-col">
                                <label for="image" class="font-medium text-sm mt-2"
                                    >passport photograph</label
                                >
                                <input
                                    @change="onImageChoose"
                                    type="file"
                                    id="image"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                />
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.image" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            </div>
                            <!--/ pasport photograph -->
                            <!-- account Role -->
                            <div class="flex flex-col">
                                <label for="image" class="font-medium text-sm mt-2"
                                    >Account Type</label
                                >
                                <select v-model="account.account_type" class="w-full outline-none border-indigo-500 border-b text-sm py-2">
                                    <option value="" disabled>Please select an account type</option>
                                    <option value="foodstuff">foodstuff</option>
                                    <option value="daily">Daily</option>
                                </select>
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.account_type" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            </div>
                            <!--/ account Role -->
                            <!-- account email_address address -->
                            <div class="flex flex-col">
                                <label for="email_address" class="font-medium text-sm mt-2"
                                    >Email address</label
                                >
                                <input
                                    v-model="account.email_address"
                                    type="email_address"
                                    id="email address"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="beritogwu@gmail.com"
                                />
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.email_address" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            </div>
                            <!--/ account Email address -->
                            </div>


                            <div class="md:w-1/2 md:ml-3">
                                
                            <!-- account phone number -->
                            <div class="flex flex-col">
                                <label for="phone_number" class="font-medium text-sm mt-2"
                                    >Phone number</label
                                >
                                <input
                                    v-model="account.phone_number"
                                    type="tel"
                                    id="phone_number"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="+2347016588973"
                                />
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.phone_number" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            </div>
                            <!--/ account phone number -->
                            <!--/ account Home address -->

                            <div class="flex flex-col">
                                <label for="title" class="font-medium text-sm mt-2"
                                    >Home address</label
                                >
                                <input type="text"
                                required
                                    v-model="account.address"
                                    class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                                    placeholder="7 mission street okeibujeun benin state"
                                >
                                <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.account_address" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                                <!-- <input type="text" id="title"> -->
                            </div>
                            <!--/ account Home address -->
                            <!-- account Password -->
                            <div class="flex flex-col">
                            <label for="password" class="font-medium text-sm mt-2"
                                >Account password</label
                            >
                            <input
                                v-model="account.password"
                                :type="typeValue"
                                id="password"
                                class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                            />
                            <p v-if="errorMsg">
                                    <ul>
                                        <li class="text-xs text-red-500" v-for="message in errorMsg.password" :key="message">{{message}}**</li>
                                    </ul>
                                </p>
                            <p v-else class="text-xs text-yellow-600">password must be up to 8 characters, a capital letter, a number and symbol </p>
                            </div>
                            <!-- /account password -->
                            <!-- account confirm Password -->
                            <div class="flex flex-col">
                            <label for="password_confirmation" class="font-medium text-sm mt-2"
                                >confirm password</label
                            >
                            <input
                                v-model="account.password_confirmation"
                                :type="typeValue"
                                id="password_confirmation"
                                class="w-full outline-none border-indigo-500 border-b text-sm py-2"
                            />
                            </div>
                            <!-- /account confirm password -->
                                <!-- <pre>{{check}}</pre> -->
                            <input type="checkbox" name="" id="showPassword" v-model="check" class="mt-6"> <label for="showPassword">show password</label>
                            </div>
                           
                        </div>
                        <div class="flex flex-end mt-5">
                                <button type="button"
                                    class="bg-red-500 cursor-pointer text-white px-5 py-3 rounded-full focus:outline focus:outline-red-500 focus:outline-offset-2"
                                    @click="CancelAddClient"
                                    >{{ cancelLoading ? 'cancelling...' : 'cancel'}}</button
                                >
                                <button
                                    class="bg-indigo-500 text-white px-5 py-3 ml-3 rounded-full focus:outline focus:outline-indigo-500 focus:outline-offset-2"
                                >
                                    {{ loading ? "please wait..." : "Submit" }}
                                </button>
                            </div>
                    </form>
                <p class="text-indigo-600 text-sm mt-2">note that account number will be authomatically generated
                     after the creation of this account, and account owners should login to their account using their provided phone numbers and password. </p>
                </div>
              <div>
        </div>
    </div>
        </div>
        </Transition 
       >
        </Teleport>
        <div v-show="!customers" class="text-center">No account as been created</div>
        <!-- <div v-if="customers.loading" class="mt-4 mx-4 text-center text-white" style="background:rgba(0,0,0,0.2)">Please wait while we fetch all accounts...</div> -->
        <!-- Loading indicator -->
        <div
                v-if="customers.loading"
                class="mt-2 flex flex-row bg-white text-green-800 justify-center items-center"
            >
                <img src="../../assets/Spinner-3.gif" class="rounded-full mr-1 h-5 w-5" />
                Please wait while all accounts are being fetched...
            </div>
            <!-- Loading indicator -->
        <div v-else class="p-4 bg-white overflow-x-auto">
            <div>
                <div v-if="loadinggetRecents" class="flex">
                    <img src="../../assets/Spinner-2.gif" alt="loading spinner" class="h-5 w-5">
                    <p class="text-sm text-gray-600">Feching latest Accounts please wait...</p>
                </div>
                <div v-else class="flex flex-col">
                    <div class="-my-2 sm:-mx-6 lg:-mx-8">
                        <div
                            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="divide-y divide-gray-200" v-if="customers">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Account name
                                            </th>
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Account number
                                            </th>
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Phone number
                                            </th>
    
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Holders address
                                            </th>
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Registeration date
                                            </th>
                                            <th
                                                scope="col"
                                                class=" text-left text-xs font-medium tracking-wider"
                                            >
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200"
                                    >
                                            
                                        <tr v-for="account in customers.data" :key="account.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                <img v-if="account.image" :src="account.image" class="h-10 w-10 rounded-full"  alt="" />
                                                <img v-else class="h-10 w-10 rounded-full"  alt="" />
                                                </div>
                                                <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-900">
                                                {{ account.account_name }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ account.email_address }}
                                                </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 rounded-full bg-green-100 text-green-800"
                                                >
                                                    {{ account.account_number }}
                                                </span>
                                            </td>
                                        
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ account.phone_number }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                {{ account.address }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-xs text-gray-500"
                                            >
                                                {{  moment(account.created_at).format('MMMM Do YYYY, h:mm:ss a') }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                            >
                                                <span @click="Deleteaccount(account.id)" class="las la-trash text-red-600 rounded-full bg-red-100 hover:bg-red-600 hover:text-white  p-1"></span>
                                                <span class="bg-green-100 text-gray-600 text-xs hover:text-green-700 font-medium ml-1 px-2 rounded py-2"><router-link :to="{name: 'AccountsView', params:{id: account.id} }">view profile <i class="las la-link"></i></router-link></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <!-- <pre>{{customers}}</pre> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add new customer form -->
        <!-- <pre>{{searchedResult}}</pre> -->
    </div>
</template>

<script setup>
    import AccountSearchedResult from '../../components/AccountSearchedResult.vue'
    import Header from '../../components/Header.vue'
    // import Pagination from '../../components/Pagination.vue'
    import BreadCrum from '../../components/BreadCrum.vue'
    import {useStore} from 'vuex';
    import {ref, computed, watch, reactive, onMounted} from 'vue';
    import {useRouter} from 'vue-router'
    import moment from 'moment'

    const store = useStore();
    const router = useRouter(); 

    const errorMsg = ref(null);

    const sam = ref('100');
    const searchField = ref('');
    const isSearching = ref(false);
    const SearchResultShouldShow = ref(false);
    const searchedResult = computed(() => store.state.allAccounts.searchedAccounts);

    const tableHead = ['account name', 'account number', 'phone number', 'owners address', 'registeration date', 'action'];


    const check = ref(false);

    const notification = computed(() => store.state.notification);

    watch(check, () => {
        check.value ? typeValue.value = !typeValue.value : typeValue.value = 'password'
    });

    const typeValue = ref('password');
    store.dispatch("GetAllClients");

    const ClientsFormShouldShow = ref(false);
    const cancelLoading = ref(false); 
    const customers = computed(() => store.state.customers.data)
    const loadinggetRecents = computed(() => store.state.customers.loading)
    const loading = ref(false);
    const account = ref({
        account_name: '',
        other_name: '',
        image: '',
        account_type: '',
        email_address: '',
        phone_number: '',
        address: '',
        image_url: '',
        password: '',
        password_confirmation: ''
    })
    function SearchAccountInfo() {
        alert('i am clicked')
        SearchResultShouldShow.value = true;
        isSearching.value = true;
        store.dispatch('searchAccountinformation', searchField.value).then(() => {
            isSearching.value = false;
        }).catch(err => {
            isSearching.value = false;
        })
    }

    function Createaccount() {
        typeValue.value = 'password';
        loading.value = true;
        store.dispatch("Createaccount", {...account.value })
        .then(({data}) => {
            store.dispatch("GetAllClients");
            loading.value = false;
            store.commit("notify", {
                type: "success",
                message: "Account was created successfully"
            });
            ClientsFormShouldShow.value = false;
            // account.value = '';
        }).catch(err => {
            loading.value = false;
            errorMsg.value = err.response.data.errors;
            console.log(err.response.data.errors);
        });
    }

    

    function CancelAddClient() {
        cancelLoading.value = true;
        setTimeout(() => {
            ClientsFormShouldShow.value = !ClientsFormShouldShow.value
            cancelLoading.value = false;
        }, 1000)
    }

    function onImageChoose(ev) {
        const file = ev.target.files[0];

        const reader = new FileReader();
        reader.onload = () => {
            account.value.image = reader.result;
            account.value.image_url = reader.result;
            ev.target.value = "";
        };

        reader.readAsDataURL(file);
    }

    function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    store.dispatch("GetAllClients", { url: link.url });

    // store.dispatch("getSurveys", );
    }

    

     function ToggleSideBar() {
    store.commit("ChangeStatus");
 }

 function AddNewCustomer() {
    ClientsFormShouldShow.value = !ClientsFormShouldShow.value
 }
 function Deleteaccount(id){
    //  console.log()
     if (confirm('are you sure you want to delete this account')) {
         store.dispatch('deleteAccount',id).then(() => {
            store.dispatch("GetAllClients");
            store.commit('notify', {
                type:'success',
                message: 'account has been deleted successfully',
            })
         })
     }
 }

 function DeleteAllCustomer() {
     if (confirm('are you sure you want to remove all clients')) {
         
     }
 }

</script>

<style scoped>
    .fade-enter-active{
        /* animation:bounce-in 0.5s; */
        transition-delay:0.25s;
        transition: 0.5s ease;

    }
    .fade-leave-active{
        /* transition: 0.5s ease; */
        transition-delay:0.25s;
        transition: 0.5s ease;
    }

    @keyframes bounce-in {
        0%{
            transform:scale(0)
        }
        50% {
            transform: scale(1.25);
        }
        100% {
            transform: scale(1);
        }
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity:0;
        transition-delay:0.25s;
        transition: 0.5s ease;
        /* animation:bounce-in 0.5s reverse; */
        
    }
</style>
