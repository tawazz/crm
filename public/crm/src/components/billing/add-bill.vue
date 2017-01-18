<template lang="html">
  <div id="addbill">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center" v-bind:class="{ 'contact': bill.id }">
          <div v-if="bill.id">
            <p><li class="fa fa-6x fa-globe "></li></p>
            <h1>{{ bill.name }}</h1>
            <p><router-link :to="{name:'billing'}" class="btn btn-default btn-lg btn-raised"  role="button">Back To Billing</router-link></p>
          </div>
          <div v-else>
            <p><li class="fa fa-6x fa-user-plus "></li></p>
            <h1>{{title}}</h1>
            <p><router-link :to="{name:'billing'}" class="btn btn-primary btn-lg"  role="button">Back To Billing</router-link></p>
          </div>

        </div>
        <div class="panel panel-default" v-show="!isLoading">
          <div class="panel-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                      <label class="control-label" for="inputSuccess2">Customer</label>
                      <select class="form-control" v-model="bill.customer_id">
                        <option v-for="customer in customers" :value="customer.id">{{customer.first_name}} {{customer.last_name}}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                      <label class="control-label">Service</label>
                      <select class="form-control" v-show="!services.length > 0">
                        <option>Loading...</option>
                      </select>
                      <select v-if="services.length > 0"class="form-control" v-model="bill.service_id" required="true">
                        <option v-for="service in userServices" :value="service.id">{{service.name}}</option>
                      </select>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                      <label class="control-label" for="inputSuccess2">Status</label>
                      <select class="form control" v-show="status.length < 1">
                          <option value="">Loading...</option>
                      </select>
                      <select v-if="status.length > 0" class="form-control" v-model="bill.status">
                          <option v-for="st in status" :value="st">{{st}}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Price</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                      <input type="number" class="form-control" v-model="bill.amount" min="1" step="any" />
                    </div>

                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Bill Due</label>
                    <input type="text" id="bill-date" class="form-control" v-model="bill.due"  />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success btn-raised" v-on:click.prevent="saveBill"> Save</button>
                  <router-link :to="{name:'billing'}" class="btn btn-warning btn-raised"> Cancel</router-link>
                  <button class="btn btn-danger btn-raised" v-show="isEdit" v-on:click.prevent="deletePromptBox"> Delete </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <loader>Saving bill Data...</loader>
         <confirmbox id="del_bill" :options="deletePrompt"></confirmbox>
      </div>
  </div>
  </div>
</template>

<script>
    import {
        $,
        bus,
        Datepicker
    } from '../../hooks.js';
    import loader from '../../util/loader.vue'
    import confirmbox from '../../util/confirmbox.vue'

    export default {
        name: 'addbill',
        components: {
            loader,
            confirmbox
        },
        data: function() {
            let vm = this;
            return {
                bill: {
                    id: null,
                    amount: '',
                    payed_on: '',
                    status: '',
                    customer_id: '',
                    service_id:''
                },
                services:{},
                status:[],
                title: 'Add New Bill',
                isLoading: false,
                customers: null,
                types: null,
                deletePrompt: {
                    icon: "<i class='fa fa-exclamation-triangle fa-2x text-danger' aria-hidden='true'></i>",
                    message: "Are you sure you want to Delete ?",
                    buttons: [{
                        text: "Delete",
                        event: "delete",
                        bsColor: "btn-danger",
                        handler: function() {
                            vm.deleteBill();
                        },
                        autoclose: true
                    }],
                    id: 'del_bill'
                },
            }
        },
        computed: {
            isEdit:function () {
                return (this.bill.id)?true:false;
            },
            userServices:function () {
                let vm =this;
                if(vm.services.length > 0){
                    return vm.services.filter(function (service) {
                        return service.customer_id == vm.bill.customer_id;
                    });
                }
            }
        },
        methods: {
            deletePromptBox: function() {
                bus.$emit('showAlert', 'del_bill');
            },
            saveBill: function() {
                var vm = this;
                if (!this.bill.id) {
                    vm.isLoading = true;
                    $.post("/api/bills", JSON.stringify(this.bill)).done(function(data) {
                        if (data.error) {
                            alert(data.error)
                        } else {
                            vm.bill = data;
                        }
                        vm.isLoading = false;
                    });
                } else {
                    vm.isLoading = true;
                    $.ajax({
                        url: "/api/bills/" + this.bill.id,
                        type: 'PUT',
                        data: JSON.stringify(vm.bill),
                        success: function(data) {
                            if (data.error) {
                                alert(data.error)
                            } else {
                                vm.bill = data;
                            }
                            vm.isLoading = false;
                        }
                    });
                }

            },
            deleteBill: function() {
                var vm = this;
                $.ajax({
                    url: "/api/bills/" + this.bill.id,
                    type: 'delete',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error)
                        } else {
                            vm.$router.push({
                                "name": "bills"
                            });
                        }
                    }
                });
            },
            getCustomers: function() {
                var vm = this;
                var url = '/api/customers';
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        vm.customers = data;
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
          getStatus:function () {
            var vm = this;
            var url = '/api/bill/status';
            $.ajax({
               url: url,
               type: 'GET',
               success: function(data) {
                 vm.status=data;
               }
            });
        }
        },
        mounted: function() {
            var vm = this;
            vm.getCustomers();
            vm.getServices();
            vm.getStatus();
            $("#bill-date").datetimepicker({
                format: 'dddd MMM Do, YYYY',
                showClear:true,
            });
            $("#bill-date").on('dp.change',function (e) {
                vm.bill.payed_on = $("#bill-date").data('DateTimePicker').date().format('YYYY-MM-DD');
            })
            if (vm.$route.params.id) {
                var url = '/api/bills/' + vm.$route.params.id;
                $.ajax({
                        method: "GET",
                        url: url,
                    })
                    .done(function(jsonData) {
                        vm.bill = jsonData
                        vm.title = 'Edit Bill';
                    });
            } else {

            }
        }
    }
</script>

<style lang="css">
</style>
