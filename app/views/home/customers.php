{% extends 'templates/default.php' %}

{% block css %}
  <link rel="stylesheet" type="text/css" href="{{baseUrl()}}/js/DataTables/datatables.min.css"/>
  <style>
    hr{
      max-width: 100%;
    }
    .btn{
      min-width: 70px;
    }
  </style>
{% endblock %}
{% block content %}
  <div class="row">
    <div class="col-lg-12">
      <h1>Users</h1>
      <hr>
    </div>
    <div class="col-lg-12">
      <a href="{{ urlFor('admin.users.add.view') }}" class="btn btn-primary"> Add User</a>
    </div>
  </div>
  <div class="row" style="margin-top:20px;">
      <div class="col-lg-12">
        <table id="userData" class="table table-striped" cellspacing="0" width="100%">
          <thead>
              <tr>
                <th>
                  #id
                </th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>
            {% for user in users %}
              <tr>
                  <td>{{user.username}}</td>
                  <td>Admin</td>
                  <td>
                    <a href="{{urlFor('admin.users.add',{'id':user.id})}}" class="btn btn-info" data-edit-{{user.id}}>Reset password</a>
                  </td>
                  <td>
                    <a href="#" class="btn btn-danger" data-delete="{{user.id}}">Delete</a>
                  </td>
              </tr>
            {% endfor %}
            </tbody>
        </table>
      </div>
    </div>

    {% include "parts/confirmbox.php"%}
{% endblock %}

{% block js %}
  <script type="text/javascript">
  $(document).ready(function() {
    $('#userData').DataTable({
      "ordering": false,
      responsive: true
    });
  });

  $('a[data-delete]').on('click',function(event){
        event.preventDefault();
        var id = $(this).attr('data-delete')
        comfirmBox({
          icon:"<i class='fa fa-exclamation-triangle fa-2x text-danger' aria-hidden='true'></i>",
          message:"Are you sure you want to Delete!!!",
          buttons:[
            {
              text:"Delete",
              onClick: "deleteUser("+id+")",
              bsColor:"btn-danger",
            }
          ]
        });
  });
  function deleteUser(id) {
    var url = "{{ urlFor('admin.users.delete',{'id':'__URL__'}) }}";
    url = url.replace('__URL__',id);
    $.ajax({
      method: "POST",
      url: url,
      data : $.param({ {{csrf_key}}: "{{csrf_token}}"})
    }).done(function( data ) {
      location.reload();
    });
  }
  </script>
{% endblock %}
