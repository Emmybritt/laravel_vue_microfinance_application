<template>
    <div class="h-screen">
        <div class="bg-white px-3 py-3 mt-4">
            <div class="flex justify-between">
                <button onclick="history.back()"><i class="las la-angle-left"></i> Go back</button>
                <router-link :to="{name: ''}">View All payin</router-link>
            </div><hr class="mt-3">
            <form class="mt-6">
      <div class="px-3 flex md:space-x-3">
        <div class="w-full">
          <label for="amount_disbursed">marketer's name</label>
          <input
            id="amount_disbursed"
            type="text"
            placeholder="enter loan id here"
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



          <div class="w-full">
          <label for="amount_pay_per_week">Amount paid</label>
            <input
              id="amount_pay_per_week"
              type="text"
              placeholder="Enter amount paid here"
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
              : "Submit payment"
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
        </div>
    </div>
</template>

<script setup>
import BreadCrum from "../components/BreadCrum.vue";
import { ref, computed, reactive } from "vue";
import { useStore } from "vuex";

const store = useStore();

const ShouldShow = ref(false);
const isLoadingState = ref(false);

</script>

<style scoped>

</style>