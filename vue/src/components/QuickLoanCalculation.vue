<template>
  <div>
    <div class="px-3 grid grid-cols-3 space-x-3">
      <!-- Amount needed starts here -->
      <div class="flex mt-3 items-center">
        <span class="font-medium text-sm antialiased text-gray-600 mr-2"
          >Amount needed:
        </span>
        <span class="text-sm text-gray-600">{{ formatNumber(amount) }}</span>
      </div>
      <!-- Amount needed ends here -->
      <!-- interest rate -->
      <div class="flex mt-3 items-center">
        <span class="font-medium text-sm antialiased text-gray-600 mr-2"
          >Interest rate:
        </span>
        <span class="text-sm text-gray-600"> 10% </span>
      </div>
      <!-- interest rate -->
      <!-- Amount to pay -->
      <div class="flex mt-3 items-center">
        <span class="font-medium text-sm antialiased text-gray-600 mr-2"
          >Interest:
        </span>
        <span class="text-sm text-gray-600">
          {{ interest().toLocaleString() }}
        </span>
      </div>
      <div class="flex mt-3 items-center">
        <span class="font-medium text-sm antialiased text-gray-600 mr-2"
          >Daily payment:
        </span>
        <span class="text-sm text-gray-600">
          {{ (parseInt(daily_payment) + 1).toLocaleString() }}
        </span>
      </div>
      <div class="flex mt-3 items-center">
        <span class="font-medium text-sm antialiased text-gray-600 mr-2"
          >Total returns:
        </span>
        <span class="text-sm text-gray-600">
          {{ total_returns().toLocaleString() }}
        </span>
      </div>
      <!-- Amount to pay -->
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
const props = defineProps({
  amount: Number,
  formatNumber: Function,
  DisburseAmount: Object,
});

props.DisburseAmount.terms_of_payment = "Daily payment"

function interest() {
  return (props.amount * 0.1).toFixed(1);
}

const daily_payment = computed(() => {
  let num = parseInt(interest());
  let pay = (props.amount / 30).toFixed(2);
  props.DisburseAmount.amount_disbursed = props.amount;
  props.DisburseAmount.weekly_payment = pay * 7;
  props.DisburseAmount.monthly_payment = pay * 30;
  if (props.DisburseAmount) {
    props.DisburseAmount.daily_payment = parseInt(pay) + 1;
  }

  return pay;
});

function total_returns() {
  let total_return = props.amount + parseInt(interest());
  if (props.DisburseAmount) {
    props.DisburseAmount.total_returns = total_return;
  }
  return total_return;
}

function weeklyPayment() {
  console.log(daily_payment);
}
</script>

<style>
</style>