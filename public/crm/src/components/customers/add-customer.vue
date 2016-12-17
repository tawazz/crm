<template lang="html">
  <div id="addCustomer">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center" v-bind:class="{ 'contact': customer.id }">
          <div v-if="customer.id">
            <p><li class="fa fa-6x fa-user "></li></p>
            <h1>{{ customer.first_name }}  {{ customer.last_name }}</h1>
            <p><router-link :to="{name:'customers'}" class="btn btn-default btn-lg btn-raised"  role="button">Back To Customers</router-link></p>
          </div>
          <div v-else>
            <p><li class="fa fa-6x fa-user-plus "></li></p>
            <h1>{{title}}</h1>
            <p><router-link :to="{name:'customers'}" class="btn btn-primary btn-lg"  role="button">Back To Customers</router-link></p>
          </div>

        </div>
        <div class="panel panel-default" v-show="!isLoading">
          <div class="panel-body">
            <form name="addCustomer">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">First Name</label>
                    <input type="text" class="form-control" v-model="customer.first_name" required="true" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Last Name</label>
                    <input type="text" class="form-control" v-model="customer.last_name" required="true" />
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
                    <input type="email" class="form-control" v-model="customer.email" required="true" />
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

              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success btn-raised" v-on:click.prevent="saveCustomer"> Save</button>
                  <router-link :to="{name:'customers'}" class="btn btn-warning btn-raised"> Cancel</router-link>
                  <button class="btn btn-danger btn-raised" v-show="isEdit" v-on:click.prevent="deletePromptBox"> Delete </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <loader>Saving Customer Data...</loader>
         <confirmbox id="del_cus" :options="deletePrompt"></confirmbox>
      </div>
  </div>
  </div>
</template>

<script>
    import {
        $,
        bus
    } from '../../hooks.js';
    import loader from '../../util/loader.vue'
    import confirmbox from '../../util/confirmbox.vue'
    import vd from 'formValidate'

    export default {
        name: 'addCustomer',
        components: {
            loader,
            confirmbox
        },
        data: function() {
            let vm = this;
            return {
                form:null,
                customer: {
                    id: null,
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    phone: '',
                    company: ''
                },
                title: 'Add New Customer',
                isLoading: false,
                deletePrompt: {
                    icon: "<i class='fa fa-exclamation-triangle fa-2x text-danger' aria-hidden='true'></i>",
                    message: "Are you sure you want to Delete ?",
                    buttons: [{
                        text: "Delete",
                        event: "delete",
                        bsColor: "btn-danger",
                        handler: function() {
                            vm.deleteCustomer();
                        },
                        autoclose: true
                    }],
                    id: 'del_cus'
                },
            }
        },
        computed: {
            isEdit:function () {
                return (this.customer.id)?true:false;
            }
        },
        methods: {
            deletePromptBox: function() {
                bus.$emit('showAlert', 'del_cus');
            },
            saveCustomer: function() {
                var vm = this;
                if (vd.validate(vm.form).isValid) {
                    if (!this.customer.id) {
                        vm.isLoading = true;
                        $.post("/api/customers", JSON.stringify(this.customer)).done(function(data) {
                            if (data.error) {
                                alert(data.error)
                            } else {
                                vm.customer = data;
                            }
                            vm.isLoading = false;
                        });
                    } else {
                        vm.isLoading = true;
                        $.ajax({
                            url: "/api/customers/" + this.customer.id,
                            type: 'PUT',
                            data: JSON.stringify(vm.customer),
                            success: function(data) {
                                if (data.error) {
                                    alert(data.error)
                                } else {
                                    vm.customer = data;
                                }
                                vm.isLoading = false;
                            }
                        });
                    }
                }
            },
            deleteCustomer: function() {
                var vm = this;
                $.ajax({
                    url: "/api/customers/" + this.customer.id,
                    type: 'delete',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error)
                        } else {
                            vm.$router.push({
                                "name": "customers"
                            });
                        }
                    }
                });
            }
        },
        mounted: function() {
            var vm = this;
            vm.form = document.forms.addCustomer;
            if (vm.$route.params.id) {
                var url = '/api/customers/' + vm.$route.params.id;
                $.ajax({
                        method: "GET",
                        url: url,
                    })
                    .done(function(jsonData) {
                        vm.customer = jsonData
                        vm.title = 'Edit Customer';
                    });
            }
        }
    }
</script>

<style lang="css">
    .contact {
        background-color: skyblue !important;
        color: whitesmoke;
    }

    .fa-6x {
        font-size: 6em;
    }
</style>
