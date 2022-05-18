<template>
  <div>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Full name
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Loan id
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Phone number
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Loan type
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Gender
          </th>
          <th
            scope="col"
            class="
              px-6
              py-3
              text-left text-xs
              font-medium
              text-gray-500
              tracking-wider
            "
          >
            Action
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, i) in loansRegisters" :key="i" class="divide-y">
          <td class="px-6 py-4 whitespace-nowrap border">
            <span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            {{ user.full_name }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border">
            <span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            {{ user.loan_number }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border">
            <span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            {{ user.phone_number }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border">
            <span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            {{ user.loan_type }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border">
            <span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            {{ user.gender }}
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap border">
            <div class="flex">
              <router-link :to="{name: 'singleLoanView', params:{id: user.id}}" href="#"><span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            <i class="las la-eye text-emerald-500 border border-emerald-500 rounded-full p-1"></i>
            </span></router-link>
            <button type="button" @click="$emit('deleteUser', user.id)"><span
              class="px-2 text-black inline-flex text-xs leading-5 rounded-full"
            >
            <i class="las la-trash text-red-600 border border-red-500 rounded-full p-1"></i>
            </span></button>
            </div>
            
          </td>

          <!-- <td class="px-6 py-4 whitespace-nowrap flex items-center">
            <router-link
              :to="{ name: 'AccountsView', params: { id: entry.id } }"
              class="
                text-indigo-500
                hover:bg-indigo-500
                p-1.5
                hover:text-white
                focus:ring focus:ring-indigo-500 focus:ring-offset-2
                inline-flex
                text-xs
                leading-5
                rounded-full
              "
            >
              <i class="las la-eye text-lg"></i>
            </router-link>
            <button
              class="
                text-red-500
                rounded-full
                hover:bg-red-300 hover:text-white
                focus:ring focus:ring-red-500 focus:ring-offset-2
                px-1
              "
            >
              <span class="las la-trash"></span>
            </button>
          </td> -->
        </tr>
      </tbody>
    </table>
    <div class="m-3">
      <a
        v-for="(link, i) of links"
        :key="i"
        :disabled="!link.url"
        href="#"
        @click.prevent="$emit('getForPage', link)"
        aria-current="page"
        v-html="link.label"
        :class="[
          link.active
            ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
          i === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
          i === links.length - 1 ? 'rounded-r-md' : '',
        ]"
        class="
          relative
          whitespace-nowrap
          font-medium
          text-xs
          inline-flex
          items-center
          px-4
          py-2
          border
        "
      ></a>
    </div>
    <div v-if="loanCounts" class="my-3 mb-4 flex justify-evenly divide-x text-gray-600">
      <div><span class="font-medium text-sm">Total normal loans</span>: {{loanCounts.normalloans}}</div>
      <div>
        <span class="font-medium text-sm">Total quick loans</span>: {{ loanCounts.quickloans }}
      </div>
      <div>
        <span class="font-medium text-sm">Total loans collected</span>:
        {{ countTotalLoans }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { useStore } from "vuex";

const props = defineProps({
  loansRegisters: Object,
  links:Object,
  loanCounts: Object,
});

defineEmits(['getForPage', 'deleteUser']);


const countTotalLoans = computed(() => {
  let toTalAmount;
  if (props.loanCounts) {
    toTalAmount = props.loanCounts.normalloans + props.loanCounts.quickloans;
  }
  return toTalAmount;
})


const store = useStore();
const gridColumns = [
  "full name",
  "loan id",
  "Phone number",
  "Loan type",
  "Gender",
  "Action",
];
</script>

<style scoped>
table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255, 255, 255, 0.66);
  cursor: pointer;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th,
td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}
</style>