<script setup>
import { usePositionStore } from "@/stores/position.js";
import { useRouter } from "vue-router";
import { onMounted } from "vue";

const position = usePositionStore();

const router = useRouter();

const traitementConfirmeVoyage = () => {
  console.log(position.majPositionActuelle());
  // Ajoute ici la logique pour confirmer le voyage
};

onMounted(async() => {
  if (position.destination.name !== '') {
    await router.push({
      name: 'position'
    });
  }
  // Géolocalisation de l'utilisateur
  console.log(position.majPositionActuelle())
  await position.majPositionActuelle()
});
</script>

<template>
  <div class="pt-16">

    <!-- Titre -->
    <h1 class="text-3xl font-semibold mb-4">
      Voici ton voyage
    </h1>

    <!-- Contenu principal -->
    <div>

      <!-- Conteneur principal -->
      <div class="overflow-hidden shadow sm:rounded-md w-9/12 mx-auto text-left">

        <!-- Conteneur interne -->
        <div class="bg-white px-4 py-5 sm:p-6">

          <!-- Carte -->
          <div>
            <GMapMap
                v-if="position.destination.name !== ''"
                :zoom="15"
                :center="position.destination.coordonnees"
                ref="gMap"
                style="width: 100%; height: 500px;">
              <!-- Ajouter ici d'autres composants ou marqueurs si nécessaire -->
            </GMapMap>
          </div>

          <!-- Destination -->
          <div class="mt-2">
            <p class="text-xl">
              Vous allez à <strong>{{ position.destination.name }}</strong>
            </p>
          </div>

        </div>

        <!-- Bouton de confirmation -->
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
              @click="traitementConfirmeVoyage"
              class="inline-flex justify-center rounded-md border border-transparent py-2 px-4 text-sm font-medium focus:outline-none shadow-sm text-white hover:bg-gray-600 bg-black"
          >
            Allons-y !
          </button>
        </div>

      </div>

    </div>

  </div>
</template>
