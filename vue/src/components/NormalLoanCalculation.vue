<template>
  <div class="px-3 grid grid-cols-3 md:space-x-3">
    <!-- Amount needed starts here -->
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Amount needed:
      </span>
      <span class="text-sm text-gray-600">{{ formatNumber(amount) }}</span>
    </div>
    <!-- Amount needed ends here -->

    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Interest rate:
      </span>
      <span class="text-sm text-gray-600"> 4% </span>
    </div>
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Miscelineous:
      </span>
      <span class="text-sm text-gray-600"> 12% </span>
    </div>
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Interest per Month:
      </span>
      <span class="text-sm text-gray-600">
        {{ getMonthlyInterest().toLocaleString() }}
      </span>
    </div>
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Interest per Week:
      </span>
      <span class="text-sm text-gray-600">
        {{ getWeeklyInterest() }}
      </span>
    </div>
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Duration:
      </span>
      <span v-if="DisburseAmount.terms_of_payment == 'Monthly payment'" class="text-sm text-gray-600"> {{ duration }} months </span>
      <span v-else-if="DisburseAmount.terms_of_payment == 'Weekly payment'" class="text-sm text-gray-600"> {{ duration * 4}} Weeks </span>
      <span v-else class="text-sm text-gray-600"> {{ duration * 30 }} days </span>
    </div>
    <!--  -->
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Initial Deposit:
      </span>
      <span class="text-sm text-gray-600">
        {{ (amount * 0.12).toLocaleString() }}
      </span>
    </div>
    <div v-if="DisburseAmount.terms_of_payment == 'Monthly payment'" class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Monthly payment:
      </span>
      <span class="text-sm text-gray-600"> {{ CalculateMonthlyPayment() }} </span>
    </div>
    <div v-else-if="DisburseAmount.terms_of_payment == 'Weekly payment'" class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Weekly payment:
      </span>
      <span class="text-sm text-gray-600"> {{ CalculateWeeklyPayment() }} </span>
    </div>
    <div v-else class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Daily payment:
      </span>
      <span class="text-xs text-gray-600"> not available for normal loan</span>
    </div>
    <div class="flex mt-3 items-center">
      <span class="font-medium text-sm antialiased text-gray-600 mr-2"
        >Total returns:
      </span>
      <span class="text-sm text-gray-600">
        {{ CalculateTotalReturns().toLocaleString() }}
      </span>
    </div>
    <!-- <pre>{{DisburseAmount}}</pre> -->
  </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';

const props = defineProps({
  amount: Number,
  formatNumber: Function,
  DisburseAmount: Object,
  duration: Number,
});

let numOfWeeks = ref(null);

  props.DisburseAmount.terms_of_payment = "Weekly payment";
  props.DisburseAmount.amount_disbursed = props.amount;

  function weeklyPayment() {
    numOfWeeks.value = props.duration * 4;
    // props.DisburseAmount.weekly_payment = 
  }

function getMonthlyInterest() {
  // props.DisburseAmount.monthly_payment = (props.amount * 0.07).toFixed(2)
  return (props.amount * 0.04).toFixed(2);
}

function getWeeklyInterest() {
  // props.DisburseAmount.weekly_payment = (props.amount * 0.07 / 4).toFixed(2)
  return (props.amount * 0.04 / 4).toFixed(2);
}

function CalculateTotalReturns() {
  let returns = props.amount + (props.amount * 0.04 * props.duration);
  props.DisburseAmount.total_returns = returns;
  return returns;
}

function CalculateWeeklyPayment() {
  const duration = props.duration * 4;
  let weeklypayment = props.amount / duration;
  let weeklyInterest = props.amount * 0.04 / 4;
  const TotalWeeklyPayment = (weeklypayment + weeklyInterest).toFixed(2);
  props.DisburseAmount.weekly_payment = TotalWeeklyPayment;
  return TotalWeeklyPayment ;
}

function CalculateMonthlyPayment() {
  const duration = props.duration;
  let weeklypayment = props.amount / duration;
  let weeklyInterest = props.amount * 0.04;
  const TotalWeeklyPayment = (weeklypayment + weeklyInterest).toFixed(2);
  props.DisburseAmount.monthly_payment = TotalWeeklyPayment;
  return TotalWeeklyPayment.toLocaleString() ;
}
</script>

<style>
</style>