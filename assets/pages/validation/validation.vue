<template>
  <div v-if="ids">

    <div class="mb-2">
      <h1 class="text-4xl font-bold">Validation réponse(s) {{ ids }}</h1>
    </div>

      <form class="flex flex-col gap-2" @submit.prevent="validate">
        <textarea v-model="reason" placeholder="Raison de la validation" class="border border-gray-300 rounded-lg p-2"></textarea>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" :class="{'cursor-not-allowed': loading,}" :disabled="loading">Valider</button>
      </form>

  </div>
  <div v-else>
    <p>Aucune réponse à valider</p>
  </div>
</template>

<script>
import api from '@/api';
import {mapActions} from "vuex";

export default {
  name: 'Validation',
  data: function () {
    return {
      reason: '',
    };
  },
  computed: {
    ids: function () {
      return this.$route.query.ids.split('-').join(', ');
    },
  },
  methods: {
    ...mapActions({
      chargerDepots: 'demande_clinique/chargerDepots',
    }),
    validate: async function() {

      try {
        this.loading = true;
        const data = JSON.stringify({
          "ids": this.$route.query.ids.split('-'),
          "reason": this.reason,
        });
        await api.demande_clinique.reponses.valider(data);
        await this.chargerDepots();
        this.$router.push('/');
      } catch (e) {
        console.error(e);
        window.alert('Une erreur est survenue');
        this.loading = false;
      }
    }
  }
}
</script>
