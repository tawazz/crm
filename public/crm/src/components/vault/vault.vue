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
                      <input type="text" class="form-control" value="" placeholder="Search">
                      <div class="input-group-addon"><li class="fa fa-search"></li></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <router-link :to="{name:'add-customer'}"  class="btn btn-info btn-raised pull-right">Add To Vault</router-link>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" v-if="vault != null" v-for="v in vault">
                      <div class="panel panel-info">
                        <div class="panel-heading text-center">
                            <i v-show="v.service.type =='website'" class="fa fa-4x fa-globe"></i>
                            <i v-show="v.service.type=='email'" class="fa fa-4x fa-envelope"></i>
                            <i v-show="v.service.type=='hosting'" class="fa fa-4x fa-server"></i>
                            <i v-show="v.service.type=='other'" class="fa fa-4x fa-bookmark"></i>
                            <h3>{{v.service.name}}</h3>
                        </div>
                        <div class="panel-body" style="padding:0;">
                          <div class="col-xs-7">
                            <small class="text-primary">{{v.url}}</small><br/>
                            <small>{{v.service.customer.first_name}} {{v.service.customer.last_name}}</small>
                          </div>
                          <div class="col-xs-5">
                            <div class="pull-right">
                              <a href="#" class="text-muted"><i class="fa fa-pencil"></i></a>
                              <a href="#" class="text-info"><i class="fa fa-share"></i></a>
                              <a href="#" class="text-danger"><i class="fa fa-trash-o"></i></a>
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
  </div>
</template>

<script>
export default {
  name:'vault',
  data:function () {
    return{
      vault:null
    };
  },
  methods:{
    openVault:function () {
      let vm =this;
      $.ajax({
        method: "GET",
        url: '/api/vault',
      })
      .done(function( jsonData) {
          vm.vault = jsonData
      });
    }
  },
  mounted:function () {
    let vm = this;
    vm.openVault();
  }
}
</script>

<style lang="css">
</style>
