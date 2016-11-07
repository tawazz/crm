{% extends 'templates/default.php' %}

{% block content %}
<div class="col-xs-12 col-sm-6 col-sm-offset-3">
  <div class="container">
    {% verbatim %}
    <div class="row" id="app">
      <div class="col-md-12">
        <template v-for="field in fields">
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" :for="field.label">{{field.label}}</label>
                  <input :type="field.type" class="form-control" :name="field.name" :value="field.value"/>
                </div>
              </div>
          </div>
        </template>
      </div>
    </div>
  </div>
  {% endverbatim %}
</div>
{% endblock %}
