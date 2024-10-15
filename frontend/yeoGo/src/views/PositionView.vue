<script setup>
import {usePositionStore} from "@/stores/position.js";

const position = usePositionStore()
const traitementChangementPosition = (e) =>{
  console.log('traitementChangementPosition', e)
  position.$patch({
    destination:{
      name:e.name,
      address: e.formatted_address,
      coordonnees:{
        lat:e.geometry.location.lat(),
        lng:e.geometry.location.lng()
      }
    }
  })
}

const traitementChoisirPosition = () =>{

}

</script>
<template>
  <div class="pt-16">

    <!-- Heading -->
    <h1 class="text-3xl font-semibold mb-4">
      Où allons-nous ?
    </h1>

    <!-- Form -->
    <form action="#" @submit.prevent="">

      <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">

        <!-- Destination -->
        <div class="bg-white px-4 py-5 sm:p-6">
          <div>
            <GMapAutocomplete
                placeholder="Ma destination "
                @place_changed="traitementChangementPosition"
                class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
            >
            </GMapAutocomplete>
          </div>
        </div>

        <!-- Soumettre -->
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
              @click.prevent="traitementChoisirPosition"
              type="button"
              class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">
            Chercher une course
          </button>
        </div>
      </div>
    </form>
  </div>

</template>