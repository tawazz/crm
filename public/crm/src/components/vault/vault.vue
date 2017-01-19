<template lang="html">
  <div id="vault">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <li class="fa fa-6x fa-lock "></li>
          <h1>Password Vault</h1>
          <p><router-link :to="{name:'home'}" class="btn btn-primary btn-lg"  role="button">Back To Dashboard</router-link></p>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="header text-center">
                  <div class="input-group">
                      <input type="text" class="form-control" v-model="search_vault" placeholder="Search">
                      <div class="input-group-addon"><li class="fa fa-search"></li></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <router-link :to="{name:'add-to-vault'}"  class="btn btn-info btn-raised pull-right">Add To Vault</router-link>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" v-if="vault != null" v-for="v in vault">
                      <div class="panel panel-info">
                        <div class="panel-heading text-center">
                            <i v-if="v.service.type =='website'" class="fa fa-4x fa-globe"></i>
                            <i v-if="v.service.type=='email'" class="fa fa-4x fa-envelope"></i>
                            <i v-if="v.service.type=='hosting'" class="fa fa-4x fa-server"></i>
                            <i v-if="v.service.type=='other'" class="fa fa-4x fa-bookmark"></i>
                            <h3>{{v.service.name}}</h3>
                        </div>
                        <div class="panel-body" style="padding:0;">
                          <div class="col-xs-7">
                            <a :href="v.url" class="text-primary" ><small >{{v.url|trim}}</small></a><br/>
                            <small>{{v.service.customer.first_name}} {{v.service.customer.last_name}}</small><br>
                            <small>{{v.notes}}</small>
                          </div>
                          <div class="col-xs-5">
                            <div class="pull-right">
                              <router-link :to="{name:'vault-edit',params:{'id':v.id}}"  class="text-muted"><i class="fa fa-pencil"></i></router-link>
                              <a href="#" class="text-info" @click.prevent="showModal(v)"><i class="fa fa-eye"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal :show="viewModal" @close="closeModal()" :title="selected_vault.service.name">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                  <label for="username">url</label>
                  <input type="text" class="form-control"  readonly="readonly" :value="selected_vault.url">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
              <div class="form-group">
                <label for="username">username</label>
                <input type="text" class="form-control"  readonly="readonly" :value="selected_vault.username">
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                <label for="username">password</label>
                <div class="input-group">
                  <input type="text" v-show="showPassword" class="form-control"  readonly="readonly" :value="selected_vault.password|base64_decode">
                  <input type="password"  v-show="!showPassword" class="form-control"  readonly="readonly" :value="selected_vault.password">
                  <span class="input-group-addon"><i :class="{'fa-eye':!showPassword, 'fa-eye-slash':showPassword}" class="fa eye"></i></span>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                  <label for="">Notes</label>
                  <textarea class="form-control" readonly="readonly">{{selected_vault.notes}}</textarea>
                </div>
            </div>
        </div>
    </modal>
  </div>
</template>

<script>
import modal from '../../util/modal.vue'
export default {
  name:'vault',
  data:function () {
    return{
      vault:null,
      og_vault:[],
      search_vault:'',
      viewModal:false,
      selected_vault:{
          service:{},
          customer:{}
      },
      showPassword:false
    };
  },
  components:{
      modal
  },
  filters:{
        base64_decode:function (val) {
            if(val){
                return atob(val);
            }
        },
        trim:function (val,len) {
            len = (len) ? len : 30;

            if (val.length > len) {
                return val.substring(0,len-3)+"..."
            }else{
                return val;
            }
        }
  },
  watch:{
    search_vault:function () {
      let vm = this;
      if (vm.vault != null) {
          if(vm.search_vault == ''){
            vm.vault = vm.og_vault;
          }
          else{
            if (vm.search_vault != '' && !vm.vault.length >0) {
              vm.vault = vm.og_vault;
            }
            vm.vault = $.grep(vm.vault, function( vault ) {
              return (vault.url.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase()) ||
               vault.username.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase()) ||
               //vault.notes.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase()) ||
               vault.service.name.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase())||
               vault.service.customer.first_name.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase())||
               vault.service.customer.last_name.toLocaleLowerCase().includes(vm.search_vault.toLocaleLowerCase()));
            });
          }
      }
    }
  },
  methods:{
        openVault:function () {
          let vm =this;
          $.ajax({
            method: "GET",
            url: '/api/vault',
          })
          .done(function( jsonData) {
              vm.vault = jsonData;
              vm.og_vault = vm.vault;
          });
      },
      showModal:function (v) {
          this.selected_vault = v;
          this.viewModal = true;
      },
      closeModal:function () {
          this.selected_vault = {
               service:{},
               customer:{}
           };
          this.showPassword =false;
          this.viewModal = false;
      }

  },
  mounted:function () {
    let vm = this;
    vm.openVault();
    $('.eye').on('click',function (e) {
        vm.showPassword = !vm.showPassword;
    });
  }
}
</script>

<style lang="css">
.eye{
    cursor: pointer;
}
</style>
