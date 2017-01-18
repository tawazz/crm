<template lang="html">
  <div id="billing">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <h1>Billing</h1>
          <p>Manage Payments</p>
          <p><router-link :to="{name:'home'}" class="btn btn-primary btn-lg"  role="button">Back To Dashboard</router-link></p>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="header text-center">
                  <h3>Billing</h3>
                  <hr>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <router-link :to="{name:'add_bill'}"  class="btn btn-info btn-raised pull-right">Add Bill</router-link>
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

export default {
  name:'billing',
  components:{
    datatable
  },
  data:function () {
    return{
      headers:['Billed To','Service','Date','Status','Price','Edit'],
      options:{
        responsive:true,
        processing:true,
        language: {
            processing: "<i class='fa fa-4x fa-spinner fa-spin'></i>"
        },
        ajax:{
          url:'/api/bills',
          dataSrc:''
        },
        columns:[
          {
              mRender:function (data,type,full) {
                  var column = "<td> __NAME__</tb>";
                  var name = full.customer.first_name +" "+full.customer.last_name;
                  return column.replace('__NAME__',name);
              }
          },
          {data:'service.name'},
          {
            mRender:function (data,type,full) {
              var column = "<td> __DATE__</tb>";
              var date = full.payed_on;
              return column.replace('__DATE__',date);
            }
          },
          {data:'status'},
          {data:'amount'},
          {
            mRender:function (data,type,full) {
              var column = "<td> <a data-edit='__ID__' class='btn btn-info' >View</a>";
              return column.replace('__ID__',full.id);
            }
          }
        ]
      },
    }
  },
  mounted:function () {
    var vm = this;
    vm.$children[2].vmDataTable.on('click','a[data-edit]',function (event) {
      event.preventDefault
      var id = $(this).attr('data-edit');
      vm.$router.push({name:'service',params:{id:id}});
    });

  }
}
</script>

<style lang="css">
</style>
