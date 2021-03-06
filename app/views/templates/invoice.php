<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CRM</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        {% include "parts/css.php" %}
        {% block css %}{% endblock %}
    </head>
    <body>
        <div class="container-fluid" style="background-color: #EEE;">
          <div class="row">
          {% block content %}{% endblock %}
          </div>
      </div>
      {% include "parts/footer.php" %}
      {% include "parts/scripts.php" %}
      {% block js %}{% endblock %}
    </body>
</html>
