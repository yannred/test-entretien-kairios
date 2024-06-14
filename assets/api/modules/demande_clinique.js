import axios from 'axios';

export default {
  depots: {
    AllNotValidatedReponse: async () => (await axios.get('/v1/demande-clinique/depots/?onlyNotValidatedReponse=1')).data,
    ajouterReponse: async (id, titre, description, type) => (await axios.post(`/v1/demande-clinique/depots/${id}/reponses`, {titre, description, type})).data,
  },
  reponses: {
    creer: async (depot) => (await axios.post('/v1/demande-clinique/reponses', depot)).data,
    valider: async (ids) => (await axios.post(`/v1/demande-clinique/reponses/valider`, ids)).data,
  }
};