<template>
  <div id="dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <h1>Customer Admin</h1>
          <p>Manage customer information</p>
          <p><router-link :to="{name:'home'}" class="btn btn-primary btn-lg"  role="button">Back To Dashboard</router-link></p>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="header text-center">
                  <h3>Customers</h3>
                  <hr>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <router-link :to="{name:'add-customer'}"  class="btn btn-info btn-raised pull-right">Add Customer</router-link>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <datatable :dtHeaders="headers" :dtOptions="options" />
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import datatable from '../../util/datatable.vue'
import {$,bus} from '../../hooks.js'

export default {
  name:'dashboard',
  components: {
    datatable
  },
  data:function () {
    return{
      vmDatatable:null,
      headers:['Customer','Email','Phone','View'],
      options:{
        responsive:true,
        columns:[
          {
            mRender:function (data,type,full) {
              var column = "<td> __NAME__</tb>";
              name = full.first_name +" "+full.last_name;
              return column.replace('__NAME__',name);
            }
          },
          {
            data:'email'
          },
          {
            data:'phone'
          },
          {
            mRender:function (data,type,full) {
              var column = "<td> <a data-edit='__ID__' class='btn btn-info' >View</a>";
              return column.replace('__ID__',full.id);
            }
          }
        ],
        language: {
            processing: "<i class='fa fa-4x fa-spinner fa-spin'></i>"
        },
        processing:true,
        ajax:{
          url:'/api/customers',
          dataSrc:''
        }
      }
    }
  },
  methods:{

  },
  beforeRouteEnter (to, from, next) {
      next(vm =>{
          if(vm.$store.state.customers.length < 1){
              $.get("/api/customers").done(function (json) {
                  vm.$store.commit("LOADCUSTOMERS",json);
              });
          }
      });
  },
  computed:{
      customers: function () {
         return this.$store.state.customers;
      }
  },
  mounted:function(){
    let vm =this;
    vm.$children[2].vmDataTable.on('click','a[data-edit]',function (event) {
      event.preventDefault
      var id = $(this).attr('data-edit');
      vm.$router.push({name:'customer',params:{id:id}});
    });

  }
}
</script>

<style>

  .header hr{
    background-color:#333;
    max-width: 200px;
  }

</style>
