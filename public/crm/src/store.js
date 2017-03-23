import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

var store = new Vuex.Store({
  state: {
    customers:[],
  },
  mutations: {
    LOADCUSTOMERS (state,c) {
        state.customers = state.customers.concat(c);
    }
  }
});

export default store;
