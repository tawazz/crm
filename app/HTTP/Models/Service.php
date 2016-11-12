<?php
  namespace HTTP\Models;
  use Illuminate\Database\Eloquent\Model as Model;

  /**
   * A service  model
   */
  class Service extends Model
  {
    protected $guarded = array();

    public static function getServices($app)
    {
      $services = $app->Service->all();
      foreach ($services as $service) {
        $customer = $app->Customer->findOrFail($service->customer_id);
        $service->customer = $customer;
      }
      return $services;
    }
  }


 ?>
