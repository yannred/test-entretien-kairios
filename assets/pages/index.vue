<template>
  <div>
    <div class="mb-2">
      <h1 class="text-4xl font-bold">Bienvenue sur ma belle application</h1>
      <p class="text-xl">Listing des demandes cliniques</p>
    </div>

    <div class="flex justify-end m-3">
      <button id="validate-button"  class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded mt-2 font-thin disabled" @click="validateReponses" title="Valider les réponses sélectionnées" disabled="disabled">Valider</button>
    </div>

    <div class="flex gap-2 flex-col w-full">
      <div 
        v-for="depot in depots"
        :key="depot.id"
        class="bg-white rounded-xl shadow-sm p-4"
      >
        <p class="text-base font-semibold">Titre: <span class="text-base text-gray-700 font-light">{{ depot.titre }}</span></p>
        <p class="text-base font-semibold">Description: <span class="text-base text-gray-700 font-light">{{ depot.description }}</span></p>
        <p class="text-base font-semibold">Date de création: <span class="text-base text-gray-700 font-light">{{ depot.date_creation }}</span></p>

        <div class="my-4 p-2 border border-gray rounded-xl bg-gray-100 flex flex-col gap-2" v-if="depot.reponses.length">

          <div class="border border-dashed border-2 bg-white px-4 pl-2 pr-1 flex" v-for="reponse in depot.reponses" :key="reponse.id">
            <div class="">
              <p class="text-base font-semibold text-red-500">Type: <span class="text-base text-gray-700 font-light">{{ getTypeLabel(reponse.type) }}</span></p>
              <p class="text-base font-semibold">Titre: <span class="text-base text-gray-700 font-light">{{ reponse.titre }}</span></p>
              <p class="text-base font-semibold">Description: <span class="text-base text-gray-700 font-light">{{ reponse.description }}</span></p>
              <p class="text-base font-semibold">Date de création: <span class="text-base text-gray-700 font-light">{{ reponse.date_creation }}</span></p>
            </div>
            <div class="mx-auto"></div>
            <div class="align-content-center text-center flex mx-2">
              <input type="checkbox" class="checkboxes" name="reponseToValidate" :id="reponse.id" @click="checkUncheck">
            </div>
          </div>

        </div>
        <div class="flex items-center justify-center" v-else>
          <p class="text-base font-semibold">Aucune réponse</p>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" @click="$router.push(`/depots/${depot.id}`)">Répondre à la demande</button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { getLabel } from '@/enum/demande_clinique/reponse/type';

export default {
  name: 'Index',
  computed: {
    ...mapGetters({
      depots: 'demande_clinique/depots',
    }),
  },
  methods: {
    getTypeLabel: getLabel,
    checkUncheck: function () {
      const checkboxes = document.querySelectorAll('.checkboxes');
      let noneChecked = true;
      checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
          noneChecked = false;
        }
      });
      const validateButton = document.querySelector('#validate-button');
      if (noneChecked) {
        validateButton.classList.add('disabled');
        validateButton.classList.remove('enabled');
        validateButton.setAttribute('disabled', 'disabled');
      } else {
        validateButton.classList.remove('disabled');
        validateButton.classList.add('enabled');
        validateButton.removeAttribute('disabled');
      }
    },
    validateReponses: function () {
      const reponsesToValidate = [];
      const checkboxes = document.querySelectorAll('.checkboxes');
      checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
          reponsesToValidate.push(checkbox.id);
        }
      });

      this.$router.push('/validation/?ids=' + reponsesToValidate.join('-'));
    },
  }
};
</script>