<template lang="html">
  <div id="services">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <h1>Services</h1>
          <p>Manage currently running services</p>
          <p><router-link :to="{name:'home'}" class="btn btn-primary btn-lg"  role="button">Back To Dashboard</router-link></p>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="header text-center">
                  <h3>Services</h3>
                  <hr>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <router-link :to="{name:'add-service'}"  class="btn btn-info btn-raised pull-right">Add Service</router-link>
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
  name:'services',
  components:{
    datatable
  },
  data:function () {
    return{
      headers:['name','type','customer','commenced','ended','edit'],
      options:{
        responsive:true,
        processing:true,
        language: {
            processing: "<i class='fa fa-4x fa-spinner fa-spin'></i>"
        },
        ajax:{
          url:'/api/services',
          dataSrc:''
        },
        columns:[
          {data:'name'},
          {data:'type'},
          {
            mRender:function (data,type,full) {
              var column = "<td> __NAME__</tb>";
              name = full.customer.first_name +" "+full.customer.last_name;
              return column.replace('__NAME__',name);
            }
          },
          {data:'service_start'},
          {data:'service_end'},
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
