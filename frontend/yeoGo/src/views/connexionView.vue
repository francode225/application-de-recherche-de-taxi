<script setup>
  import { vMaska } from "maska/vue"
  import axios from "axios"
  import {onMounted, reactive, ref} from "vue";
  import {useRouter} from 'vue-router'

  const router = useRouter()

  const identification = reactive({
    telephone : null,
    code_confirmation : null
  })

  const attendreVerification = ref(false)

  onMounted(()=>{
    if (localStorage.getItem('token')){
      router.push({
        name:'landing'
      })
    }
  })

  const traitementConnexion = () => {
    const formattedPhone = identification.telephone
        .replaceAll(' ', '').replace('(', '').replace(')', '').replaceAll('-', '');
    console.log(formattedPhone)
    axios.post('http://localhost:8000/api/login', {
      phone: formattedPhone
    })
        .then((response) => {
          console.log(response.data)
          attendreVerification.value = true
        })
        .catch((error) => {
          console.error(error)
          alert(error.response.data.message)
        });
  }

  const traitementVerification = ()=>{
    const formattedPhone = identification.telephone
        .replaceAll(' ', '').replace('(', '').replace(')', '').replaceAll('-', '');

    const formatCode = identification.code_confirmation
        .replace('-','');
    console.log(formatCode)
    axios.post('http://localhost:8000/api/login/verify',{
      phone : formattedPhone,
      login_code : formatCode
    })
        .then((response) => {
          console.log(response.data)
          localStorage.setItem('token', response.data.token)
          router.push({
            name: 'landing'
          })
        })
        .catch((error) => {
          console.error(error)
          alert(error.response.data.message)
        });
  }


</script>
<template>
  <div class="pt-16">
    <h1 class="text-3xl font-semibold mb-4">
      Entrez votre numero de telephone
    </h1>
    <form v-if="!attendreVerification" action="#"  @submit.prevent="traitementConnexion">
      <div
          class="overflow-hidden
                        shadow
                        sm:rounded-md
                        max-w-sm
                        mx-auto
                        text-left"
      >
        <!--  numero de telephone -->
        <div class="bg-white px-4 py-5 sm:p-6">
          <div>
            <input
                v-maska
                data-maska="(+225) ##-##-##-##-##"
                v-model="identification.telephone"
                type="text"
                name="phone"
                id="phone"
                placeholder="(+225) 01-02-03-04-05"
                class="mt-1
                                    block
                                    w-full
                                    px-3
                                    py-2
                                    rounded-md
                                    border
                                    shadow-sm
                                    focus:outline-none
                                    border-gray-300
                                    focus:border-black"
            >
          </div>
        </div>

        <!-- soumettre -->
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
              type="submit"
              @submit.prevent="traitementConnexion"
              class="inline-flex
                                justify-center
                                rounded-md
                                border
                                border-transparent
                                py-2
                                px-4
                                text-sm
                                font-medium
                                shadow-sm
                                focus:outline-none
                                bg-black
                                hover:bg-gray-600
                                text-white"
          >
            Enregistrer
          </button>
        </div>

      </div>
    </form>

    <!-- Verification Formulaire -->
    <form v-else action="#" @submit.prevent="traitementVerification">
      <div
          class="overflow-hidden
                        shadow
                        sm:rounded-md
                        max-w-sm
                        mx-auto
                        text-left"
      >

        <!-- code de connexion -->
        <div class="bg-white px-4 py-5 sm:p-6">
          <div>
            <input
                v-maska
                v-model="identification.code_confirmation"
                data-maska="###-###"
                type="text"
                name="login_code"
                id="login_code"
                placeholder="123456"
                class="mt-1
                                    block
                                    w-full
                                    px-3
                                    py-2
                                    rounded-md
                                    border
                                    shadow-sm
                                    focus:outline-none
                                    border-gray-300
                                    focus:border-black"
            >
          </div>
        </div>

        <!-- Soumettre -->
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
              type="submit"
              class="inline-flex
                                justify-center
                                rounded-md
                                border
                                border-transparent
                                py-2
                                px-4
                                text-sm
                                font-medium
                                shadow-sm
                                focus:outline-none
                                bg-black
                                hover:bg-gray-600
                                text-white"
          >
            Verify
          </button>
        </div>

      </div>

    </form>

  </div>

</template>

<style>

</style>