import api from '@/api';

export default {
  namespaced: true,
  state: {
    depots: [],
  },
  mutations: {
    SET_DEPOTS(state, depots) {
      state.depots = depots;
    }
  },
  actions: {
    async chargerDepots({commit}) {
      commit('SET_DEPOTS', await api.demande_clinique.depots.AllNotValidatedReponse());
    },
  },
  getters: {
    depots: state => state.depots,
  }
};