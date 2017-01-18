<template lang="html">
  <div id="addservice">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center" v-bind:class="{ 'contact': service.id }">
          <div v-if="service.id">
            <p><li class="fa fa-6x fa-globe "></li></p>
            <h1>{{ service.name }}</h1>
            <p><router-link :to="{name:'services'}" class="btn btn-default btn-lg btn-raised"  role="button">Back To services</router-link></p>
          </div>
          <div v-else>
            <p><li class="fa fa-6x fa-user-plus "></li></p>
            <h1>{{title}}</h1>
            <p><router-link :to="{name:'services'}" class="btn btn-primary btn-lg"  role="button">Back To services</router-link></p>
          </div>

        </div>
        <div class="panel panel-default" v-show="!isLoading">
          <div class="panel-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Service Name</label>
                    <input type="text" class="form-control" v-model="service.name" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Service Type</label>
                    <select class="form-control" v-model="service.type">
                      <option v-for="type in types" :value="type">{{type}}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Customer</label>
                    <select class="form-control" v-model="service.customer_id">
                      <option v-for="customer in customers" :value="customer.id">{{customer.first_name}} {{customer.last_name}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Service Started</label>
                    <input type="text" id="service_start" class="form-control"   />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Service Ended</label>
                    <input type="text" id="service_end" class="form-control"  />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-success btn-raised" v-on:click.prevent="saveService"> Save</button>
                  <router-link :to="{name:'services'}" class="btn btn-warning btn-raised"> Cancel</router-link>
                  <button class="btn btn-danger btn-raised" v-show="isEdit" v-on:click.prevent="deletePromptBox"> Delete </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <loader>Saving service Data...</loader>
         <confirmbox id="del_ser" :options="deletePrompt"></confirmbox>
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
        name: 'addservice',
        components: {
            loader,
            confirmbox
        },
        data: function() {
            let vm = this;
            return {
                service: {
                    id: null,
                    name: '',
                    type: '',
                    service_start: '',
                    service_end: '',
                    customer_id: '',
                },
                title: 'Add New Service',
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
                            vm.deleteService();
                        },
                        autoclose: true
                    }],
                    id: 'del_ser'
                },
                serviceStartDatepicker:null,
                serviceEndDatepicker:null
            }
        },
        computed: {
            isEdit:function () {
                return (this.service.id)?true:false;
            }
        },
        methods: {
            deletePromptBox: function() {
                bus.$emit('showAlert', 'del_ser');
            },
            saveService: function() {
                var vm = this;
                if (!this.service.id) {
                    vm.isLoading = true;
                    $.post("/api/services", JSON.stringify(this.service)).done(function(data) {
                        if (data.error) {
                            alert(data.error)
                        } else {
                            vm.service = data;
                        }
                        vm.isLoading = false;
                    });
                } else {
                    vm.isLoading = true;
                    $.ajax({
                        url: "/api/services/" + this.service.id,
                        type: 'PUT',
                        data: JSON.stringify(vm.service),
                        success: function(data) {
                            if (data.error) {
                                alert(data.error)
                            } else {
                                vm.service = data;
                            }
                            vm.isLoading = false;
                        }
                    });
                }

            },
            deleteService: function() {
                var vm = this;
                $.ajax({
                    url: "/api/services/" + this.service.id,
                    type: 'delete',
                    success: function(data) {
                        if (data.error) {
                            alert(data.error)
                        } else {
                            vm.$router.push({
                                "name": "services"
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
            getTypes: function() {
                var vm = this;
                var url = '/api/services/types';
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        vm.types = data;
                    }
                });
            },
            handleEvents:function () {
                let vm = this;
                vm.serviceStartDatepicker = $("#service_start").datetimepicker({
                    format: 'ddd MMM Do, YYYY',
                    showClear:true,
                });
                vm.serviceEndDatepicker = $("#service_end").datetimepicker({
                    format: 'ddd MMM Do, YYYY',
                    showClear:true,
                });

                vm.serviceStartDatepicker.on('dp.change',function (e) {
                    vm.service.service_start = vm.serviceStartDatepicker.data('DateTimePicker').date().format('YYYY-MM-DD');
                    vm.serviceEndDatepicker.data("DateTimePicker").minDate(e.date);
                });

                vm.serviceEndDatepicker.on('dp.change',function (e) {
                    vm.service.service_end = vm.serviceEndDatepicker.data('DateTimePicker').date().format('YYYY-MM-DD');
                });
            }
        },
        mounted: function() {
            var vm = this;
            vm.getCustomers();
            vm.getTypes();
            vm.handleEvents();
            if (vm.$route.params.id) {
                var url = '/api/services/' + vm.$route.params.id;
                $.ajax({
                        method: "GET",
                        url: url,
                    })
                    .done(function(jsonData) {
                        vm.service = jsonData
                        vm.title = 'Edit Service';
                        vm.serviceStartDatepicker.data("DateTimePicker").date(new Date(vm.service.service_start));
                        vm.serviceEndDatepicker.data("DateTimePicker").date(new Date(vm.service.service_end));
                    });
            } else {

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
