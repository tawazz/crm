<?php
  namespace HTTP\Models;
  use HTTP\Models\BaseModel as Model;
  use HTTP\Models\Customer as Customer;

  /**
   * A service  model
   */
  class Service extends Model
  {
    protected $guarded = array();

    public static function getServices($app)
    {
      $services = Service::all();
      foreach ($services as $service) {
        $customer = Customer::findOrFail($service->customer_id);
        $service->customer = $customer;
      }
      return $services;
    }

    public static function getTypesOptions(){
      $options = Service::getPossbileEnumValues('type');

      return $options;
    }

    public static function getServiceWithCustomer($id)
    {
      $service = Service::findOrFail($id);
      $customer = Customer::findOrFail($service->customer_id);
      $service->customer = $customer;

      return $service;
    }

    public function vaults()
    {
      return $this->hasMany('HTTP\Models\Vault');
    }

    public function customer()
    {
      return $this->belongsTo('HTTP\Models\Customer');
    }
  }


 ?>
