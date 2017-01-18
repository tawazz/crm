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
import billing from './components/billing/billing.vue'
import invoice from './components/billing/invoice.vue'
import addBill from './components/billing/add-bill.vue'
import NProgress from 'vue-nprogress'
import Router from 'vue-router'
var css = require('./hook-css.js');
Vue.use(Router);
Vue.use(NProgress);

global.$ = $
const nprogress = new NProgress({
    parent: '.navbar' ,
    easing: 'ease',
    speed: 1000,
    minimum: 0.1,
    trickleRate: 0.08,
    trickleSpeed: 1000,
    showSpinner: false
});

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
          path:'/dashboard/customers/edit/:id',
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
          path:'/dashboard/services/:id',
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
        },
        {
          path:'/dashboard/vault/:id',
          name:'vault-edit',
          component:add_to_vault
        },
        {
          path:'/dashboard/billing',
          name:'billing',
          component:billing
        },
        {
          path:'/dashboard/billing/add',
          name:'add_bill',
          component:addBill
        },
        {
          path:'/dashboard/billing/edit/:id',
          name:'edit_bill',
          component:addBill
        },
        {
          path:'/dashboard/billing/invoice/:id',
          name:'invoice',
          component:invoice
        },

];

const router = new Router({
  'routes' : routes,
  'mode': 'history'
});

const v = new Vue({
  router,
  nprogress
}).$mount('#app');
