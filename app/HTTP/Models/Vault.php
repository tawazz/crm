<?php
  namespace HTTP\Models;
  use HTTP\Models\BaseModel as Model;
  use HTTP\Models\Service as Service;
  /**
   * A password vault  model
   */
  class Vault extends Model
  {
    protected $guarded = array();
    protected $table = 'vault';

    public static function openVault()
    {
      $vault = Vault::all();
      foreach ($vault as $v) {
        $service = Service::getServiceWithCustomer($v->service_id);
        $v->service = $service;
      }
      return $vault;
    }

  }


 ?>
