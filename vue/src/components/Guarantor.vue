<template>
  <div class="md:flex mt-6">
            <div class="md:w-1/3">
                <label for="" class="font-medium text-lg tracking-wider text-indigo-700">{{index + 1}}. Guarantors Agreement form</label>
                <p class="text-xs mt-2 text-gray-600 md:text-left text-center">This is information must be the information of the Guarantor.</p>
            </div>
            <div class="md:w-2/3 pl-4 pr-3 md:space-y-3">
                <!-- First step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">guarantor's Fullname</label>
                        <input type="text" v-model="guarantor.full_name" class="outline-none border rounded-md mt-1 text-sm w-full px-2 py-1 focus:outline-indigo-400" placeholder="Obaniyi peter oseni">
                    </div>
                   <div class="flex flex-col w-full ml-1">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">date of birth</label>
                        <input type="date" v-model="guarantor.age" class="outline-none text-gray-600 text-sm border rounded-md mt-1 w-full text-gray px-2 py-1 focus:outline-indigo-400">
                    </div>
                </div>
                <!-- First step starts here-->
                <!-- First step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guarantors profile Photo </label>
                        <div class="mt-1 flex items-center">
                        <img v-if="guarantor.image_url" class="h-[50px] pa-1 rounded border w-[50px]" :src="guarantor.image_url" :alt="guarantor.full_name">
                        <span v-else class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <button type="button" class="ml-5 relative bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <input type="file" @change="ChangeGuarantorsImage" class="absolute inset-0 opacity-0"> Change</button>
                        </div>
                    </div>
                      
              </div>

              
                <!-- First step starts here-->
                <!-- Second step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">Gender</label>
                        <select v-model="guarantor.gender" name="" id="" class="outline-none border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                   <div class="flex flex-col w-full ml-1">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">LGA</label>
                        <input type="text" placeholder="ojo" v-model="guarantor.lga" class="outline-none border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400" />
                    </div>
                </div>
                <!-- Second step starts here-->
                <!-- Third step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">gaurantors Nationality</label>
                        <select name="" id="" class="outline-none border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400">
                            <option value="" disabled>Select country</option>
                            <option value="">+234 - Nigeria</option>
                            <option v-for="(country, i) in countries" :key="i" :value="country.name">
                                    <p class="ml-2">+{{country.phone}} - {{country.name}}</p>                                
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">guarantors state of origin</label>
                        <input v-model="guarantor.state" type="text" class="outline-none capitalize border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400" placeholder="Lagos">
                    </div>
                </div>
                <!-- Third step starts here-->
                <!-- Fourth step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">guarantors Residential address</label>
                        <input type="text" v-model="guarantor.residential_address" class="outline-none capitalize border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400" placeholder="7 mission street okeibujeun">
                    </div>
                   <div class="flex flex-col w-full ml-1">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">guarantors Occupation</label>
                        <input type="text" v-model="guarantor.occupation" class="outline-none text-gray-600 text-sm border rounded-md mt-1 w-full text-gray px-2 py-1 focus:outline-indigo-400" placeholder="Trader">
                    </div>
                </div>
                <!-- Fourth step starts here-->
                 <!-- Fifth step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">Nature of business</label>
                        <input type="text" v-model="guarantor.nature_of_business" class="outline-none capitalize border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400" placeholder="eg selling of fish and snails">
                    </div>
                   <div class="flex flex-col w-full ml-1">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">Business/Office Address</label>
                        <input type="text" v-model="guarantor.address_of_business" class="outline-none text-gray-600 text-sm border rounded-md mt-1 w-full text-gray px-2 py-1 focus:outline-indigo-400" placeholder="7 mission street">
                    </div>
                </div>
                <!-- Fifth step starts here-->
                <!-- Sixth step starts here -->
                <div class="md:flex justify-between md:space-y-0 space-y-3 md:mt-0 mt-3">
                    <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">guarantors Phone number</label>
                        <input type="number" v-model="guarantor.phone_no" class="outline-none capitalize border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400" placeholder="eg +2347016588973">
                    </div>
                   <div class="flex flex-col ml-1 w-full">
                        <label for="fullname" class="text-sm text-gray-500 uppercase font-medium">Relationship</label>
                        <select name="" v-model="guarantor.relationship" id="" class="outline-none border rounded-md mt-1 w-full px-2 text-sm py-1 focus:outline-indigo-400">
                            <option disabled>Select relationship</option>
                            <option v-for="(relationship, index) in relationships" :key="index" :value="relationship">{{relationship}}</option>
                        </select>
                    </div>
                </div>
                <!-- Sixth step starts here-->
                                <!-- <pre>{{guarantor}}</pre> -->
            </div>
        </div>
</template>

<script setup>
const props = defineProps({
    countries: Object,
    relationships: Array,
    guarantor: Object,
    index: Number,
});
const emit = defineEmits(['ChangeGuarantorsImage'])

function ChangeGuarantorsImage(ev) {
    emit("ChangeGuarantorsImage", props.index, ev);
}



</script>

<style>

</style>