<template lang="html" id="modal">
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" >{{title}}</h4>
          </div>
          <div class="modal-body">
              <slot></slot>
          </div>
          <div class="modal-footer">
             <slot name="footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
             </slot>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    name:'modal',
    props:{
        size:{
            default:"modal-sm"
        },
        show:{
            default:false
        },
        title:{
            default:""
        }
    },
    data:function () {
        let vm =this;
        return{
            id:"modal_"+vm._uid
        }
    },
    watch:{
        show:function () {
            let vm = this;
            if (vm.show) {
                vm.showModal();
            }else{
                vm.hideModal();
            }
        }
    },
    methods:{
        showModal:function () {
            let vm =this;
            $('#'+vm.id).modal('show');
        },
        hideModal:function () {
            let vm =this;
            $('#'+vm.id).modal('hide');
        }
    },
    mounted:function () {
        let vm =this;
        $('#'+vm.id).on('hidden.bs.modal', function (e) {
          vm.$emit("close");
        })
    }
}
</script>

<style lang="css">
</style>
