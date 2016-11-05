// The following line loads the standalone build of Vue instead of the runtime-only build,
// so you don't have to do: import Vue from 'vue/dist/vue'
// This is done with the browser options. For the config, see package.json
import Vue from 'vue'
import dashboard from './components/dash-menu.vue'
import users from './components/users.vue'
import Router from 'vue-router'
import $ from './hooks'
Vue.use(Router);

global.$ = $


const routes = [
        {
          path:'/dashboard/customers',
          component: users,
          name:'customers'
        },
        {
          path:'/',
          component: dashboard,
          name:'home'
        }

];

const router = new Router({
  'routes' : routes,
  'mode': 'history'
});

new Vue({
  'router':router
}).$mount('#app');
