<template lang="html">
  <div id="addCustomer">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <h1>{{title}}</h1>
          <p><li class="fa fa-2x fa-user-plus "></li></p>
          <p><router-link :to="{name:'customers'}" class="btn btn-primary btn-lg"  role="button">Back To Customers</router-link></p>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">First Name</label>
                    <input type="text" class="form-control" v-model="customer.first_name" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Last Name</label>
                    <input type="text" class="form-control" v-model="customer.last_name"  />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Company</label>
                    <input type="text" class="form-control" v-model="customer.company"  />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Email</label>
                    <input type="email" class="form-control" v-model="customer.email"  />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Phone</label>
                    <input type="text" class="form-control" v-model="customer.phone"  />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Address</label>
                    <textarea type="text" class="form-control" v-model="customer.address" ></textarea>
                  </div>
                </div>
              </div>
              <input type="hidden" >
              <div class="row">
                <div class="col-md-12">
                  <a href="#" class="btn btn-success btn-raised" id="saveBtn"> Save</a>
                  <router-link :to="{name:'customers'}" class="btn btn-warning btn-raised"> Cancel</router-link>
                  <router-link :to="{name:'customers'}" class="btn btn-danger btn-raised"> Delete </router-link>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
  </div>
  </div>
</template>

<script>
import {$} from '../hooks.js';

export default {
  name:'addCustomer',
  data:function () {
    return{
      customer:{
        first_name:'',
        last_name:'',
        email:'',
        address:'',
        phone:'',
        company:''
      },
      title:'Add New Customer'
    }
  },
  mounted:function () {
    var vm = this;
    if(vm.$route.params.id){
      var url = '/api/customers/'+vm.$route.params.id;
      $.ajax({
        method: "GET",
        url: url,
      })
      .done(function( jsonData) {
          vm.customer = jsonData
          vm.title = 'Edit Customer'
      });
    }
  }
}
</script>

<style lang="css">
</style>
