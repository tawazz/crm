<template lang="html">
  <div id="addtovault">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center" v-bind:class="{ 'contact': vault.id }">
          <div v-if="vault.id">
            <p><li class="fa fa-6x fa-globe "></li></p>
            <h1>{{ vault.service.name }}</h1>
            <p><router-link :to="{name:'vault'}" class="btn btn-default btn-lg btn-raised"  role="button">Back To vault</router-link></p>
          </div>
          <div v-else>
            <p><li class="fa fa-6x fa-user-plus "></li></p>
            <h1>{{title}}</h1>
            <p><router-link :to="{name:'vault'}" class="btn btn-primary btn-lg"  role="button">Back To vault</router-link></p>
          </div>

        </div>
        <div class="panel panel-default" v-show="!isLoading">
          <div class="panel-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" >URL</label>
                    <input type="text" class="form-control" v-model="vault.url" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label">Service</label>
                    <select class="form-control" v-show="!services.length > 0">
                      <option>Loading...</option>
                    </select>
                    <select v-if="services.length > 0"class="form-control" v-model="vault.service_id">
                      <option v-for="service in services" :value="service.id">{{service.name}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">username</label>
                    <input type="text" class="form-control" v-model="vault.username">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">password</label>
                    <input type="password" class="form-control" v-model="vault.password"  />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Notes</label>
                    <textarea class="form-control" v-model="vault.notes"  />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success btn-raised" v-on:click.prevent='saveVault'> Save</button>
                  <router-link :to="{name:'vault'}" class="btn btn-warning btn-raised"> Cancel</router-link>
                  <button class="btn btn-danger btn-raised" v-on:click.prevent='deleteVault'> Delete </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <loader>Saving Vault Data...</loader>
      </div>
  </div>
  </div>
</template>

<script>
import {$} from '../../hooks.js';
import loader from '../../util/loader.vue'

export default {
  name:'addtovault',
  components:{
    loader
  },
  data:function () {
    return{
      vault:{

      },
      title:'Add To Vault',
      isLoading:false,
      customers:null,
      types:null,
      services:{}
    }
  },
  watch:{
  },
  methods:{
    saveVault:function(){
      var vm=this;
      if(!this.vault.id){
        vm.isLoading = true;
        $.post( "/api/vault",JSON.stringify(this.vault))
        . done(function( data ) {
          vm.vault = data;
          vm.isLoading = false;
          vm.$router.push({name:'vault'});
        })
        .fail(function (data) {
            alert(data.error)
        });
      }else{
        vm.isLoading = true;
        delete vm.vault.service;
        $.ajax({
           url: "/api/vault/"+this.vault.id,
           type: 'PUT',
           data: JSON.stringify(vm.vault),
           success: function(data) {
             if(data.error){
               alert(data.error)
             }else{
               vm.vault = data;
             }
             vm.isLoading = false;
             vm.$router.push({name:'vault'});
           }
        });
      }

    },
    deleteVault:function () {
      var vm =this;
      $.ajax({
         url: "/api/vault/"+this.vault.id,
         type: 'delete',
         success: function(data) {
           if(data.error){
             alert(data.error)
           }else{
             vm.$router.push({"name":"vault"});
           }
         }
      });
    },
    getServices:function () {
      var vm = this;
      var url = '/api/services';
      $.ajax({
         url: url,
         type: 'GET',
         success: function(data) {
           vm.services=data;
         }
      });
    },
    fetchVault:function () {
      let vm =this;
      if(vm.$route.params.id){
        var url = '/api/vault/'+vm.$route.params.id;
        $.ajax({
          method: "GET",
          url: url,
        })
        .done(function( jsonData) {
            vm.vault= jsonData
            vm.title = 'Edit Vault';
        });
      }else {

      }
    },
  },
  mounted:function () {
    var vm = this;
    vm.fetchVault();
    vm.getServices();
  }
}
</script>

<style lang="css">
.contact{
  background-color: skyblue !important;
  color:whitesmoke;
}
.fa-6x {
    font-size: 6em;
}
</style>
