<script setup>

  import {useRouter} from "vue-router";

  const router = useRouter()
  const traitementChercherCourse = () =>{
    router.push({
      name: 'position'
    })
  }
  const traitementDebuterCourse = () =>{

  }



</script>
<template>
  <div class="pt-16">

    <!-- Heading -->
    <h1 class="text-3xl font-semibold mb-4">YeoGO</h1>

    <!-- Content -->
    <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
      <div class="bg-white px-4 py-5 sm:p-6">
        <div class="flex justify-between">
          <!-- commencer la conduite -->
          <button
              @click="traitementDebuterCourse"
              class="rounded-md
                                border
                                border-transparent
                                py-2
                                px-4
                                text-sm
                                font-medium
                                shadow-sm
                                focus:outline-none
                                text-white
                                hover:bg-gray-600
                                bg-black"
          >
            Start Driving
          </button>

          <!-- Chercher une course -->
          <button
              @click="traitementChercherCourse"
              class="rounded-md
                                border
                                border-transparent
                                py-2
                                px-4
                                text-sm
                                font-medium
                                shadow-sm
                                focus:outline-none
                                text-white
                                hover:bg-gray-600
                                bg-black"
          >
            Find A Ride
          </button>
        </div>
      </div>
    </div>
  </div>
</template>