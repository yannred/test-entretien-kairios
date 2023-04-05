<template>
  <div v-if="depot">
    <div class="mb-2">
      <h1 class="text-4xl font-bold">{{ depot.titre }}</h1>
      <p class="text-xl">{{ depot.description }}</p>
    </div>
    <div class="mt-4 px-4 py-2 bg-white rounded-xl">
      <h2 class="text-md font-semibold">Création d'une nouvelle réponse</h2>
      <form class="flex flex-col gap-2" @submit.prevent="creer">
        <input type="text" v-model="titre" placeholder="Titre" class="border border-gray-300 rounded-lg p-2">
        <textarea v-model="description" placeholder="Description" class="border border-gray-300 rounded-lg p-2"></textarea>
        <select v-model="type" class="border border-gray-300 rounded-lg p-2" placeholder="Priorité">
          <option selected disabled value="0">Type de réponse</option>
          <option v-for="type in getTypes()" :value="type" :key="type">{{ getTypeLabel(type) }}</option>
        </select>
        <button 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          :class="{
            'cursor-not-allowed': loading,
          }"
          :disabled="loading"
        >{{ loading ? 'En cours' : 'Creer' }}</button>
      </form>
    </div>
  </div>
  <div v-else>
    <p>Le dépot n'existe pas</p>
  </div> 
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import api from '@/api';
import {getAll, getLabel} from '@/enum/demande_clinique/reponse/type';

export default {
  name: 'Depot',
  data: function () {
    return {
      titre: '',
      description: '',
      loading: false,
      type: 0,
    };
  },
  computed: {
    ...mapGetters({
      depots: 'demande_clinique/depots',
    }),
    id: function () {
      return parseInt(this.$route.params.id);
    },
    depot: function () {
      return this.depots.find((depot) => depot.id === this.id);
    },
  },
  methods: {
    ...mapActions({
      chargerDepots: 'demande_clinique/chargerDepots',
    }),
    getTypes: getAll,
    getTypeLabel: getLabel,
    creer: async function() {
      if (!(this.titre && this.description)) {
        window.alert('Veuillez remplir tous les champs');
        return;
      }

      try {
        this.loading = true;
        await api.demande_clinique.depots.ajouterReponse(this.depot.id, this.titre, this.description, this.type);
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
