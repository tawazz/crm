{% extends 'templates/invoice.php' %}

{% block content %}
  <div class="container text-center" style="background-color: #EEE;">
    <section class="bg-primary">
      <div class="row">
        <div class="col-sm-4">
          <h2>Tawanda Nyakudjga</h2>
          <p>
            ABN 123456789
          </p>
        </div>
        <div class="col-sm-8">
            <h2>Invoice</h2><h3>Order # 00001</h3>
        </div>
      </div>
    </section>
    <section>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-info">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-6">
                        <address class="text-left">
                          <h3>
                            Billed To:<br>
                            Givemore Naini
                          </h3>
                          <p>
                            ABN 50 610 681 297
                          </p>
                        </address>
                      </div>
                      <div class="col-xs-6">
                        <h3>Thursday, November 17 2016</h3>
                      </div>
                  </div>
              </div>
                <div class="panel-footer text-primary">
                    <span class="pull-left"><li class="fa fa-globe "></li> website development (gandtservices.com.au)</span>
                    <span class="pull-right"><i class="fa fa-usd">300.00</i></span>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-footer text-primary">
                    <span class="pull-left"> <li class="fa fa-server "></li> website hosting (gandtservices.com.au)</span>
                    <span class="pull-right"><i class="fa fa-usd">75.00</i></span>
                    <div class="clearfix"></div>
                </div>
              <div class="panel-footer">
                  <span class="pull-left">Total <span class="label label-success">PAID</span> </span>
                  <span class="pull-right"><i class="fa fa-usd">375.00</i></span>
                  <div class="clearfix"></div>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

{% endblock %}
{% block style %}
  <style media="print">
    body{
      font-size: 2em;
    }
  </style>
{% endblock%}
