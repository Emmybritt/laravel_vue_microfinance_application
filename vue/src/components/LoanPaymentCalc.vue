<template>
  <div>
    <h1
      class="
        text-lg
        px-4
        text-indigo-500
        antialiased
        border-b-2 border-collapse border-indigo-500
        inline
      "
    >
      Other related Loan information
    </h1>
    <div v-if="registeredLoanUSer">
      <div v-if="registeredLoanUSer.loan_type !== 'quickloan'">
        <NormalLoanCalculation
          :amount="registeredLoanUSer.amount_needed"
          :DisburseAmount="DisburseAmount"
          :formatNumber="formatNumber"
          :duration="registeredLoanUSer.duration"
        />
      </div>
      <div v-else>
        <QuickLoanCalculation
          :formatNumber="formatNumber"
          :amount="registeredLoanUSer.amount_needed"
          :DisburseAmount="DisburseAmount"
        />
      </div>
    </div>

    <form @submit.prevent="DisburseLoan" class="mt-6">
      <div class="px-3 flex md:space-x-3">
        <div>
          <label for="amount_disbursed">Amount disbursed</label>
          <input
            v-model="DisburseAmount.amount_disbursed"
            id="amount_disbursed"
            type="text"
            placeholder="5000"
            class="
              outline-none
              text-gray-600 text-sm
              border
              rounded-md
              mt-1
              w-full
              text-gray
              px-2
              py-3
              focus:outline-indigo-400
            "
          />
        </div>
        <div v-if="registeredLoanUSer">
          <div v-if="registeredLoanUSer.loan_type !== 'normalloan'">
            <label for="amount_pay_per_week">Daily payment</label>
            <input
              id="amount_pay_per_week"
              type="text"
              placeholder="5000"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-3
                focus:outline-indigo-400
              "
              v-model="DisburseAmount.daily_payment"
            />
          </div>
        </div>

        <div v-if="registeredLoanUSer">
          <div v-if="registeredLoanUSer.loan_type !== 'quickloan'">
          <div v-if="DisburseAmount.terms_of_payment == 'Weekly payment'">
          <label for="amount_pay_per_week">weekly payment</label>
            <input
              v-model="DisburseAmount.weekly_payment"
              id="amount_pay_per_week"
              type="text"
              placeholder="5000"
              :class="[
                registeredLoanUSer.loan_type !== 'quickloan' ? '' : 'hidden',
              ]"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-3
                focus:outline-indigo-400
              "
            />
          </div>
          <div v-else-if="DisburseAmount.terms_of_payment == 'Monthly payment'">
          <label for="amount_pay_per_week">Monthly payment</label>
            <input
              v-model="DisburseAmount.monthly_payment"
              id="amount_pay_per_week"
              type="text"
              placeholder="5000"
              :class="[
                registeredLoanUSer.loan_type !== 'quickloan' ? '' : 'hidden',
              ]"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-3
                focus:outline-indigo-400
              "
            />
          </div>
          <div v-else>
          <label for="amount_pay_per_week">Daily payment</label>
            <input
              v-model="DisburseAmount.daily_payment"
              id="amount_pay_per_week"
              type="text"
              placeholder="5000"
              :class="[
                registeredLoanUSer.loan_type !== 'quickloan' ? '' : 'hidden',
              ]"
              class="
                outline-none
                text-gray-600 text-sm
                border
                rounded-md
                mt-1
                w-full
                text-gray
                px-2
                py-3
                focus:outline-indigo-400
              "
            />
          </div>
            
          </div>
        </div>
        <div>
          <label for="amount_pay_per_week">Terms of payment</label>
          <select
            v-model="DisburseAmount.terms_of_payment"
            class="
              outline-none
              text-gray-600 text-sm
              border
              rounded-md
              mt-1
              w-full
              text-gray
              px-2
              py-3
              focus:outline-indigo-400
            "
            name=""
            id=""
          >
            <option value="Daily payment">Daily payment</option>
            <option value="Weekly payment">Weekly payment</option>
            <option value="Monthly payment">Monthly payment</option>
          </select>
        </div>
      </div>
      <div class="flex flex-col sm:flex-row mt-4 px-2">
        <button
          :disabled="isLoadingState"
          :class="[
            isLoadingState ? 'cursor-not-allowed opacity-75' : 'cursor-pointer',
          ]"
          class="
            px-3
            py-2
            rounded-md
            text-white
            bg-indigo-600
            focus:outline-indigo-300 focus:outline
            w-full
            mr-1
          "
        >
          {{
            isLoadingState
              ? "Disbursement in progress..."
              : "Proceed disbursement"
          }}
        </button>
        <button
          type="button"
          class="
            px-3
            py-2
            rounded-md
            text-white
            bg-pink-600
            focus:outline-pink-300 focus:outline
            w-full
            ml-1
          "
        >
          Cancel
        </button>
      </div>
    </form>
    <div class="bg-green-600 text-white text-xs px-4 py-2 mt-3" v-if="notification.show">
      {{ notification.message }}
    </div>

    
    <!-- <pre>
          {{ registeredLoanUSer }}
      </pre
    > -->
  </div>
</template>

<script setup>
import { computed, reactive, ref, onMounted } from "vue";
import { useStore } from "vuex";
import {useRoute} from 'vue-router';
import NormalLoanCalculation from "./NormalLoanCalculation.vue";
import QuickLoanCalculation from "./QuickLoanCalculation.vue";

const store = useStore();
const isLoadingState = ref(false);

let errorMsg = ref(null);

const route = useRoute();

const props = defineProps({
  registeredLoanUSer: Object,
});
const notification = computed(() => store.state.notification);

const DisburseAmount = reactive({
  loan_id: null,
  amount_disbursed: null,
  daily_payment: null,
  weekly_payment: null,
  monthly_payment: null,
  total_returns: null,
  terms_of_payment: "",
  status: false,
});

DisburseAmount.loan_id = route.params.id;


function formatNumber(num) {
  const n = num;
  // DisburseAmount.amount_disbursed = n;
  return n.toLocaleString("en-US");
}

function DisburseLoan() {
  if (confirm('are you sure you want disburse')) {
    isLoadingState.value = true;
  store.dispatch("disburse", DisburseAmount).then((res) => {
    isLoadingState.value = false;
    store.commit("notify", {
      type: 'success',
      message: 'Amount has been entered successfully'
    })
  }).catch(err => {
  isLoadingState.value = false;
  errorMsg.value = err.response.data.errors;
  });
  }
  
}
</script>

<style>
</style>