{% extends 'templates/default.php' %}

{% block content %}
  <div class="container text-center" style="background-color: #EEE;">
    <div class="row">
      {% verbatim %}
      <div class="col-lg-12" id="dashboard">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <h1>Admin Console</h1>
              </hr>
            </div>
          </div>
        </div>
        <template v-for="menu in menus">
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
        </template>
      </div>
      {% endverbatim %}
    </div>
  </div>

{% endblock %}
{% block js %}
<script type="text/javascript">
  new Vue({
    el:"#dashboard",
    data:{
      menus:[
        {
          title:"Customers",
          description : "add, edit and manage customers",
          icon : "fa-users"
        },
        {
          title:"Sites",
          description : "manage sites",
          icon : "fa-globe"
        },
        {
          title:"Billing",
          description : "view and manage charges",
          icon : "fa-credit-card-alt"
        },
        {
          title:"Vault",
          description : "manage security and features",
          icon : "fa-lock"
        },
        {
          title:"Servers",
          description : "view and manage servers",
          icon : "fa-desktop"
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
  });
</script>

{% endblock%}
