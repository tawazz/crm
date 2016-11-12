<?php
namespace HTTP\Models;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Model;
  /**
   *
   */
  class BaseModel extends Model
  {

    public static function getPossbileEnumValues($name){
      $instance = new static; // create an instance of the model to be able to get the table name
      $type = DB::select( DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$name.'"') )[0]->Type;
      preg_match('/^enum\((.*)\)$/', $type, $matches);
      $enum = array();
      foreach(explode(',', $matches[1]) as $value){
         $v = trim( $value, "'" );
         $enum[] = $v;
      }
      return $enum;
    }
  }

 ?>
