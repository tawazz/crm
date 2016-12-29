{% extends 'templates/default.php' %}

{% block content %}
  <div class="container" style="background-color: #EEE; " id="app">
    <router-view style="margin-top:15px;"></router-view>
  </div>
{% endblock %}
{% block js %}

{% endblock%}
