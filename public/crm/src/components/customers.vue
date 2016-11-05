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
import datatable from '../util/datatable.vue'
import {$} from '../hooks.js'

export default {
  name:'dashboard',
  components: {
    datatable
  },
  data:function () {
    return{
      vmDatatable:null,
      headers:['Customer','Email','Phone','Vault','Edit'],
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
            mRender:function () {
              return "<td> <a href='' class='btn btn-default' >Vault</a>"
            }
          },
          {
            mRender:function (data,type,full) {
              var column = "<td> <a data-edit='__ID__' class='btn btn-info' >Edit</a>";
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
  mounted:function(){

    $('a[data-edit]').on('click',function (event) {
      event.preventDefault
      alert('clicked');
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
