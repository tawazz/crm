// The following line loads the standalone build of Vue instead of the runtime-only build,
// so you don't have to do: import Vue from 'vue/dist/vue'
// This is done with the browser options. For the config, see package.json
import Vue from 'vue'
import dashboard from './components/dash-menu.vue'
import customers from './components/customers/customers.vue'
import addCustomer from './components/customers/add-customer.vue'
import services from './components/services/services.vue'
import addService from './components/services/add-service.vue'
import vault from './components/vault/vault.vue'
import add_to_vault from './components/vault/addtovault.vue'
import Router from 'vue-router'
Vue.use(Router);

global.$ = $


const routes = [
        {
          path:'/',
          component: dashboard,
          name:'home'
        },
        {
          path:'/dashboard/customers',
          component: customers,
          name:'customers',
        },
        {
          path:'/dashboard/customers/:id',
          name:'customer',
          component:addCustomer
        },
        {
          path:'/dashboard/customers/add',
          name:'add-customer',
          component:addCustomer
        },
        {
          path:'/dashboard/services',
          name:'services',
          component:services
        },
        {
          path:'/dashboard/customers/:id',
          name:'service',
          component:addService
        },
        {
          path:'/dashboard/services/add',
          name:'add-service',
          component:addService
        },
        {
          path:'/dashboard/vault',
          name:'vault',
          component:vault
      },
      {
        path:'/dashboard/vault/add',
        name:'add-to-vault',
        component:add_to_vault
      }

];

const router = new Router({
  'routes' : routes,
  'mode': 'history'
});

new Vue({
  'router':router
}).$mount('#app');
