<template>
  <form
    @submit.prevent="registerLoan"
    class="mt-6 border rounded-md px-4 py-3 mb-4"
  >
    <!-- 
          Loan collectors information here
       -->
    <!-- <pre>{{errorMsg}}</pre> -->
    <!-- <pre>{{notification}}</pre> -->

    <div class="md:flex py-2">
      <div class="md:w-1/3">
        <label for="" class="font-medium text-lg tracking-wider text-indigo-700"
          >Personal information</label
        >
        <p class="text-xs mt-2 text-gray-600 md:text-left text-center">
          This is information must be the information of the party the loan
          would be disbursed to.
        </p>
      </div>
      <div class="md:w-2/3 pl-4 pr-3 md:space-y-3">
        <!-- First step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Fullname</label
            >
            <input
              type="text"
              v-model="loanFormDatas.full_name"
              class="
                outline-none
                border
                rounded-md
                mt-1
                text-sm
                w-full
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="Obaniyi peter oseni"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >date of birth</label
            >
            <input
              type="date"
              v-model="loanFormDatas.age"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
            />
          </div>
        </div>
        <!-- First step starts here-->
        <!-- First step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Loan Type</label
            >
            <select
              v-model="loanFormDatas.loan_type"
              class="
                outline-none
                border
                rounded-md
                mt-1
                text-sm
                w-full
                px-2
                py-1
                focus:outline-indigo-400
              "
            >
              <option value="" disabled>Select loan type</option>
              <option value="quickloan">Quick Loan</option>
              <option value="normalloan">Normal Loan</option>
            </select>
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Phone number</label
            >
            <input
              type="number"
              placeholder="+2347016588973"
              v-model="loanFormDatas.phone_number"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
            />
          </div>
        </div>
        <!-- First step starts here-->
        <!-- First step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Photo
            </label>
            <div class="mt-1 flex items-center">
              <img
                v-if="loanFormDatas.image_url"
                class="h-[70px] w-[70px] rounded border p-0.5"
                :src="loanFormDatas.image_url"
                alt=""
              />
              <span
                v-else
                class="
                  inline-block
                  h-12
                  w-12
                  rounded-full
                  overflow-hidden
                  bg-gray-100
                "
              >
                <svg
                  class="h-full w-full text-gray-300"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
                  />
                </svg>
              </span>
              <button
                type="button"
                class="
                  ml-5
                  relative
                  bg-white
                  py-2
                  px-3
                  border border-gray-300
                  rounded-md
                  shadow-sm
                  text-sm
                  leading-4
                  font-medium
                  text-gray-700
                  hover:bg-gray-50
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-indigo-500
                "
              >
                <input
                  type="file"
                  @change="ChangeImage"
                  class="absolute inset-0 opacity-0"
                />
                Change
              </button>
            </div>
          </div>
        </div>

        <!-- First step starts here-->
        <!-- Second step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Gender</label
            >
            <select
              v-model="loanFormDatas.gender"
              name=""
              id=""
              class="
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
            >
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Religion</label
            >
            <select
              name=""
              id=""
              v-model="loanFormDatas.religion"
              class="
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
            >
              <option disabled>Select a religion</option>
              <option
                v-for="(religion, i) in religions"
                :key="i"
                :value="religion"
              >
                {{ religion }}
              </option>
            </select>
          </div>
        </div>
        <!-- Second step starts here-->
        <!-- Third step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Nationality</label
            >
            <select
              v-model="loanFormDatas.nationality"
              name=""
              id=""
              class="
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
            >
              <option value="" disabled>Select country</option>
              <option value="nigeria">+234 - Nigeria</option>
              <option
                v-for="(country, i) in countries"
                :key="i"
                :value="country.name"
              >
                <p class="ml-2">+{{ country.phone }} - {{ country.name }}</p>
              </option>
            </select>
          </div>
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >state of origin</label
            >
            <input
              type="text"
              v-model="loanFormDatas.state"
              class="
                outline-none
                capitalize
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="Lagos"
            />
          </div>
        </div>
        <!-- Third step starts here-->
        <!-- Fourth step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Residential address</label
            >
            <input
              type="text"
              v-model="loanFormDatas.residential_address"
              class="
                outline-none
                capitalize
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="7 mission street okeibujeun"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Occupation</label
            >
            <input
              v-model="loanFormDatas.occupation"
              type="text"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="Trader"
            />
          </div>
        </div>
        <!-- Fourth step starts here-->
        <!-- Fourth step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >LGA</label
            >
            <input
              type="text"
              v-model="loanFormDatas.LGA"
              class="
                uppercase
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="Ojo"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >starting Date of payment</label
            >
            <input
              v-model="loanFormDatas.day_of_payment"
              type="date"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="Trader"
            />
          </div>
        </div>
        <!-- Fourth step starts here-->
        <!-- Fifth step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Nature of business</label
            >
            <input
              v-model="loanFormDatas.nature_of_business"
              type="text"
              class="
                outline-none
                capitalize
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg selling of fish and snails"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Business/Office Address</label
            >
            <input
              type="text"
              v-model="loanFormDatas.office_address"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="7 mission street"
            />
          </div>
        </div>
        <!-- Fifth step starts here-->
        <!-- Sixth step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Purpose of loan</label
            >
            <input
              v-model="loanFormDatas.purpose_of_loan"
              type="text"
              class="
                outline-none
                capitalize
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg for stocking my shop with fish and snails"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Amount needed</label
            >
            <input
              v-model="loanFormDatas.amount_needed"
              type="number"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg 250,000"
            />
          </div>
        </div>
        <!-- Sixth step starts here-->
        <!-- Seventh step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Duration of payment</label
            >
            <input
              type="number"
              v-model="loanFormDatas.duration"
              class="
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="(select numbers of month) eg. 2"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Method of payment</label
            >
            <input
              type="text"
              v-model="loanFormDatas.method_of_payment"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg Transfer"
            />
          </div>
        </div>
        <!-- Seventh step starts here-->
        <!-- eight step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Collateral</label
            >
            <input
              type="text"
              v-model="loanFormDatas.collateral"
              class="
                outline-none
                border
                rounded-md
                mt-1
                w-full
                px-2
                text-sm
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg. 3 plot of land"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Mandatory savings</label
            >
            <input
              type="number"
              v-model="loanFormDatas.mandatory_savings"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="eg 3000"
            />
          </div>
        </div>
        <!-- eight step starts here-->
      </div>
    </div>
    <hr />
    <!-- 
          Loan collectors information ends here
       -->
    <!-- 
            Next of kin information here
         -->
    <div class="md:flex mt-6">
      <div class="md:w-1/3">
        <label for="" class="font-medium text-lg tracking-wider text-indigo-700"
          >Next of kin information</label
        >
        <p class="text-xs mt-2 text-gray-600 md:text-left text-center">
          This is information must be the information of the next of kin.
        </p>
      </div>
      <div class="md:w-2/3 pl-4 pr-3 md:space-y-3">
        <!-- First step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col ml-1 w-full">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Fullname</label
            >
            <input
              type="text"
              v-model="loanFormDatas.nextOfKin.name"
              class="
                outline-none
                border
                rounded-md
                mt-1
                text-sm
                w-full
                px-2
                py-1
                focus:outline-indigo-400
              "
              placeholder="Obaniyi peter oseni"
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Relationship</label
            >
            <input
              type="text"
              v-model="loanFormDatas.nextOfKin.relationship"
              placeholder="eg Father"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
            />
          </div>
        </div>
        <!-- First step starts here-->
        <!-- Second step starts here -->
        <div
          class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3"
        >
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Address</label
            >
            <input
              type="text"
              v-model="loanFormDatas.nextOfKin.address"
              placeholder="eg 7 mission street morogbo okeibujeun"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
            />
          </div>
          <div class="flex flex-col w-full ml-1">
            <label
              for="fullname"
              class="text-sm text-gray-500 uppercase font-medium"
              >Phone number</label
            >
            <input
              type="number"
              v-model="loanFormDatas.nextOfKin.phone_no"
              placeholder="eg. +2347016588973"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-1
                focus:outline-indigo-400
              "
            />
          </div>
        </div>
        <!-- Second step starts here-->
        <!-- Second step starts here -->

        <!-- Second step starts here-->
      </div>
    </div>
    <!-- 
            Next of kin information ends here
         -->

    <!-- 
          Loan collectors information ends here
       -->
    <!-- 
            Guarantors information here
         -->
    <hr class="mt-4" />
    <div v-if="loanFormDatas.guarantors.length">
      <div v-for="(guarantor, i) in loanFormDatas.guarantors" :key="i">
        <Guarantor
          :countries="countries"
          :relationships="relationships"
          :guarantor="guarantor"
          :index="i"
          @ChangeGuarantorsImage="imageChange"
        />
      </div>
    </div>

    <div class="flex justify-end">
      <button
        type="button"
        v-if="loanFormDatas.guarantors.length > 1"
        @click="removeLastAdded"
        class="bg-red-500 mr-1 text-white px-3 mt-3"
      >
        Remove last added guarantor <i class="las la-minus"></i>
      </button>
      <button
        type="button"
        @click="addNewGuarantor"
        class="bg-gray-700 text-white px-3 mt-3"
      >
        Add new Guarantor <i class="las la-plus"></i>
      </button>
    </div>

    <!-- 
            Guarantors information ends here
         -->
    <hr class="mt-3" />
    <div class="flex flex-col items-center">
      <div class="flex flex-col w-full ml-1">
        <label
          for="fullname"
          class="text-sm text-gray-500 uppercase font-medium"
          >Affirmation</label
        >
      </div>
      <div class="flex mt-2">
        <input type="checkbox" required />
        <p class="text-sm ml-2">
          I
          <b class="border-b border-indigo-500">{{
            loanFormDatas.full_name ? loanFormDatas.full_name : "No name"
          }}</b>
          Declare that this information above are true and i agree to terms and
          condition of any action taken by the above named organization to
          recover their loan and interest in case of any unforseen
          circumstances.
        </p>
      </div>
    </div>
    <!-- Submit buttons starts here -->
    <div class="flex justify-end my-3">
      <div v-if="route.params.id">
        <router-link
          :to="{ name: 'DisbursementPage', params: { id: route.params.id } }"
          class="
            bg-pink-600
            px-6
            py-2
            rounded
            text-white
            focus:outline focus:outline-pink-300
            mr-3
            hover:bg-pink-700
            font-medium
          "
          >Proceed to disbursement page</router-link
        >
      </div>

      <button
        v-if="!route.params.id"
        :disabled="isLoading"
        :class="{
          'cursor-not-allowed hover:bg-indigo-500 bg-indigo-500': isLoading,
        }"
        class="
          bg-indigo-600
          px-6
          py-2
          rounded
          text-white
          focus:outline focus:outline-indigo-300
          hover:bg-indigo-700
          font-medium
        "
      >
        {{ isLoading ? "Submitting form..." : "Submit form" }}
      </button>
      <button
        v-else
        :disabled="isLoading"
        :class="{
          'cursor-not-allowed hover:bg-indigo-500 bg-indigo-500': isLoading,
        }"
        class="
          bg-indigo-600
          px-6
          py-2
          rounded
          text-white
          focus:outline focus:outline-indigo-300
          hover:bg-indigo-700
          font-medium
        "
      >
        {{ isLoading ? "Updating form..." : "Update form" }}
      </button>
      <input
        type="reset"
        class="
          ml-2
          bg-green-600
          px-6
          py-2
          rounded
          text-white
          focus:outline focus:outline-green-300
          hover:bg-green-700
          font-medium
        "
        value="Reset form"
      />
    </div>
    <!-- <pre>{{ loanFormDatas }}</pre> -->
    <!-- Submit buttons starts here -->
    <div
      v-if="notification.show"
      :class="{ 'bg-emerald-600': notification.type === 'success' }"
      class="px-4 text-white rounded sticky bottom-4 right-4 shadow-md py-2"
    >
      {{ notification.message }}
    </div>
  </form>
</template>

<script setup>
import { useCountries } from "../countries.js";
import { reactive, ref, watch, computed, onMounted } from "vue";
import { v4 as uuidv4 } from "uuid";
import Guarantor from "./Guarantor.vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";

const store = useStore();
const route = useRoute();
const router = useRouter();

const { countries } = useCountries();
const notification = computed(() => store.state.notification);
const isLoading = ref(false);
const errorMsg = ref([]);
const relationships = reactive([
  "mother",
  "father",
  "aunty",
  "cousin",
  "friend",
  "niece",
  "brother",
  "sister",
  "relatives",
  "inlaw",
  "husband",
  "wife",
  "landlord",
  "tenant",
  "mistress",
]);

const loanFormDatas = ref({
  // branch_id: 1,
  full_name: "",
  loan_type: "",
  phone_number: "",
  image: null,
  image_url: null,
  age: "",
  religion: "",
  gender: "male",
  nationality: "",
  state: "",
  LGA: "",
  residential_address: "",
  occupation: "",
  nature_of_business: "",
  office_address: "",
  purpose_of_loan: "",
  amount_needed: null,
  duration: null,
  method_of_payment: "",
  day_of_payment: "",
  mandatory_savings: null,
  default_fee: 1000,
  collateral: "",
  status: false,
  nextOfKin: {
    name: "",
    relationship: "",
    address: "",
    phone_no: "",
  },
  guarantors: [
    {
      image_url: "",
      guarantors_image: "",
      full_name: "",
      age: "",
      gender: "",
      state: "",
      lga: "",
      residential_address: "",
      occupation: "",
      phone_no: "",
      nature_of_business: "",
      address_of_business: "",
      relationship: "",
    },
  ],
});
const religions = ["Christian", "muslim", "traditional worshiper", "other"];

onMounted(() => {
  watch(
    () => store.state.loan.data.data,
    (newVal, OldVal) => {
      loanFormDatas.value = {
        ...JSON.parse(JSON.stringify(newVal)),
      };
    }
  );
});

onMounted(() => {
  if (route.params.id) {
    store.dispatch("getLoan", route.params.id);
  }
});

function imageChange(index, ev) {
  console.log(index);
  const file = ev.target.files[0];

  const reader = new FileReader();

  reader.onload = () => {
    loanFormDatas.value.guarantors[index].guarantors_image = reader.result;
    loanFormDatas.value.guarantors[index].image_url = reader.result;
    ev.target.value = "";
  };
  reader.readAsDataURL(file);
}

function ChangeImage(ev) {
  const file = ev.target.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    // The field to send on backend and apply validations
    loanFormDatas.value.image = reader.result;

    // The field to display here
    loanFormDatas.value.image_url = reader.result;
    ev.target.value = "";
  };
  reader.readAsDataURL(file);
}

function addNewGuarantor() {
  const newGuarantor = {
    image_url: "",
    guarantors_image: "",
    full_name: "",
    age: "",
    gender: "",
    state: "",
    lga: "",
    residential_address: "",
    occupation: "",
    phone_no: "",
    nature_of_business: "",
    address_of_business: "",
    relationship: "",
  };
  // loanFormDatas.value.guarantors.splice(index + 1, 0, newGuarantor);
  loanFormDatas.value.guarantors.push(newGuarantor);
}

function removeLastAdded() {
  loanFormDatas.value.guarantors.pop();
}

function registerLoan() {
  isLoading.value = true;
  let action = "created";
  if (loanFormDatas.value.id) {
    action = "updated";
  }
  store
    .dispatch("SubmitForm", { ...loanFormDatas.value })
    .then(({ data }) => {
      errorMsg.value = null;
      isLoading.value = false;
      store.commit("notify", {
        type: "success",
        message: "The Loan registeration was successfully " + action,
      });
      router.push({
        name: "LoanView",
        params: { id: data.data.id },
      });
    })
    .catch((err) => {
      isLoading.value = false;
      errorMsg.value = err.response.data.errors;
    });
}
</script>

<style>
</style>