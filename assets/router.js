import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
  routes: [
    {name: 'index', path: '/', component: () => import('./pages/index.vue')},
    {name: 'depot', path: '/depots/:id', component: () => import('./pages/depots/_id.vue')},
    {name: 'validation', path: '/validation', query: {ids: ""}, component: () => import('./pages/validation/validation.vue')},
  ]
})