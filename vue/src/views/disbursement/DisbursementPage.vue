<template>
  <div class="h-screen">
    <!-- <BreadCrum title="Loan registeration" /> -->
    <div v-if="IsLoading" class="px-6 py-3 flex bg-white mt-2">
      <img src="../../assets/Spinner-2.gif" alt="" class="h-4 w-4 mr-1">
      <p class="text-xs">Please wait as the user information is being fetched...</p>
    </div>
    <div v-else-if="!registeredLoanUSer" class="px-6 py-3 flex-col items-center flex bg-white mt-2">
      <h1 class="text-4xl">Oops!!! 404</h1>
      <p>The page you are looking for is not found... <button class="text-indigo-500" onclick="history.back()">Click here to go back</button></p>
    </div>
    <div v-else class="px-6 py-3 bg-white mt-2">
      <div class="flex justify-between">
        <button class="text-sm rounded px-2 py-1" onclick="history.back()">
          <span class="las la-angle-left"></span> Go back
        </button>
        <router-link
          class="text-sm"
          :to="{ name: 'LoanView', params: { id: route.params.id } }"
          >Edit user</router-link
        >
      </div>
      <hr />
      <div class="pt-4">
        <div class="md:flex divide-x">
          <div class="md:w-1/3">
            <div>
              <h1
                class="
                  font-medium
                  inline
                  border-b-2 border-indigo-300
                  text-lg text-indigo-500
                  shadow-md
                "
              >
                Loan Information page
              </h1>
              <div
                class="space-y-3 divide-y mt-4 overflow-y-scroll h-[400px]"
                v-if="registeredLoanUSer"
              >
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Full name:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.full_name
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Loan id:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.loan_number
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Loan type:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.loan_type
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Occupation:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.occupation
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Religion:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.religion
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Nature of bussines:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.nature_of_business
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Residential address:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.residential_address
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Nationality:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.nationality
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">State of origin:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.state
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Residential address:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.residential_address
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Registered date:</h1>
                  <span class="text-sm text-gray-600">{{
                    moment(registeredLoanUSer.created_at).format(
                      "MMMM Do YYYY h:mm:ss a"
                    )
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">method of payment:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.method_of_payment
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Day to start payment:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.day_of_payment
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Purpose of Loan:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.purpose_of_loan
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Mandatory savings:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.mandatory_savings
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Default fee:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.default_fee
                  }}</span>
                </div>
                <div class="flex justify-between px-4">
                  <h1 class="text-sm font-medium">Collateral:</h1>
                  <span class="text-sm text-gray-600">{{
                    registeredLoanUSer.collateral
                  }}</span>
                </div>

                <!-- Next of kin starts here -->
                <div v-if="registeredLoanUSer.nextOfKin">
                  <h1 class="font-medium text-indigo-600">
                    Next of information
                  </h1>
                  <div class="space-y-3">
                    <NextOfKinComponent
                      :nextOfKin="registeredLoanUSer.nextOfKin"
                    />
                  </div>
                </div>
                <!-- Next of kin page ends here -->

                <!-- Guarantor starts here -->
                <div v-if="Object.values(registeredLoanUSer.guarantors).length">
                  <h1 class="font-medium text-indigo-600">
                    Guarantors information
                  </h1>
                  <div class="space-y-3">
                    <GuarantorComponent
                      :guarantors="Object.values(registeredLoanUSer.guarantors)"
                    />
                  </div>
                </div>
                <!-- Guarantor page ends here -->
              </div>
            </div>
          </div>
          <div class="md:w-2/3">
            <LoanPaymentCalc :registeredLoanUSer="registeredLoanUSer" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useStore } from "vuex";
import GuarantorComponent from "../../components/GuarantorComponent.vue";
import { useRouter, useRoute } from "vue-router";
import { computed, ref, reactive } from "vue";
import moment from "moment";
import NextOfKinComponent from "../../components/NextOfkinComponent.vue";
import LoanPaymentCalc from "../../components/LoanPaymentCalc.vue";

const store = useStore();
const route = useRoute();
const IsLoading = ref(true);

const registeredLoanUSer = computed(() => store.state.loan.data.data);

if (route.params.id) {
  store.dispatch("getLoan", route.params.id).then(({data}) => {
    IsLoading.value = false;
  }).catch(err => {
    IsLoading.value = false;
  })
} else {
  router.push("404");
}
</script>

<style>
</style>