<?php
  namespace HTTP\Models;
  use HTTP\Models\BaseModel as Model;
  use HTTP\Models\Service as Service;
  /**
   * A password billing  model
   */
  class Billing extends Model
  {
    protected $guarded = array();
    protected $table = 'billing';

    public static function bills()
    {
      $billing = Billing::all();
      foreach ($billing as $b) {
        $service = $b->service;
        $customer = $b->customer;
        $b->service = $service;
        $b->customer = $customer;
        unset($b->customer_id);
        unset($b->service_id);
      }
      return $billing;
    }

    public function service()
    {
        return $this->belongsTo('HTTP\Models\Service');
    }
    public function customer()
    {
        return $this->belongsTo('HTTP\Models\Customer');
    }
    public static function getTypesOptions(){
      $options = Billing::getPossbileEnumValues('status');
      return $options;
    }

  }


 ?>
