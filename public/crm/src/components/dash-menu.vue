<template >
  <div id="dashboard" class="text-center">
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-12">
          <div class="jumbotron">
            <h1>Admin, Console</h1>
            <p>This is a simple admin console , for managing business and customer information</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
          </div>
        </div>
        <router-link :to="menu.url" v-if="menu.url"  v-for="menu in menus">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <i v-bind:class="[menu.icon]" class="fa fa-4x fa-user" aria-hidden="true"></i>
                <p class="fa-2x">
                  {{ menu.title }}
                </p>
              </div>
              <div class="panel-body">
                <p>
                  <small><b>{{ menu.description }}</b></small>
                </p>
              </div>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>

</template>

<script>
import base_path from '../hooks.js'

export default {
  name :'dashboard',
  data:function () {
    return {
      menus:[
        {
          title:"Customers",
          description : "add, edit and manage customers",
          icon : "fa-users",
          url:"/dashboard/customers"
        },
        {
          title:"Services",
          description : "manage services",
          icon : "fa-globe",
          url:"/dashboard/services"
        },
        {
          title:"Billing",
          description : "view and manage charges",
          icon : "fa-credit-card-alt",
          url:'/dashboard/vault'
        },
        {
          title:"Vault",
          description : "manage security and features",
          icon : "fa-lock",
          url:'/dashboard/vault'
        },
        {
          title:"Servers",
          description : "view and manage servers",
          icon : "fa-desktop",
          url:'/dashboard/vault'
        },
        {
          title:"Accounting",
          description : "business accounting",
          icon : "fa-usd"
        },
        {
          title:"Reports",
          description : "business reports",
          icon : "fa-file-pdf-o"
        },
        {
          title:"Documents",
          description : "manage contracts and invoices",
          icon : "fa-file-text"
        }
      ]
    }
  }
}
</script>

<style lang="css">
</style>
