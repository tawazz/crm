<template lang="html">
   <div id="DataTable">
      <table class="hover table table-striped dt-responsive nowrap" cellspacing="0" width="100%"  id="table">
            <thead >
                <tr>
                    <th v-for="header in dtHeaders"> {{ header}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
   </div>

</template>

<script>
import {$, DataTable, DataTableBs,DataTableRes} from '../hooks'

module.exports = {
   name : 'DataTable',
   props:{
      dtHeaders:{
         type:Array,
         required:true
      },
      dtOptions: {
         type:Object,
         required:true
      }
   },
   data : function () {
     return {
       vmDataTable:null
     }
   },
   watch:{
     vmDataTable:function () {
       this.$parent.vmDataTable = this.vmDataTable;
     }
   },
   computed:{
     parentDataTable:function () {
       this.$parent.vmDataTable = this.vmDataTable;
     }
   },
   mounted:function () {
      let vm = this;
      var table =$('#table');
      vm.vmDataTable = $(table).DataTable(vm.dtOptions);
      vm.vmDataTable.search('').draw();

      vm.vmDataTable.on('click','a[data-edit]',function (event) {
        event.preventDefault
        var id = $(this).attr('data-edit');
        vm.$router.push({name:'customer',params:{id:id}});
      });
   }
};
</script>

<style lang="css">
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
    vertical-align: middle;
  }
  div.dataTables_wrapper div.dataTables_processing {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 200px;
  margin-left: -100px;
  margin-top: -26px;
  text-align: center;
  padding: 1em 0;
  background: transparent;
  }
  .pagination,.dataTables_filter {
    float: right;
  }
</style>
