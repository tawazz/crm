<?php

  /**
   * a bootstrap form builder class
   */
  class FormBuilder
  {

    private $field_html,$row,$col_size;

    function __construct(argument)
    {
      $field_html =
      "
        <div class=\"row\">
            <div class=\"__col_size__\">
              <div class=\"form-group\">
                <label class=\"control-label\" for=\"__label__\">__label__</label>
                <input type=\"__field__\" class=\"form-control\" name=\"__name__\" value=\"__value__\"/>
              </div>
            </div>
        </div>
      ";
    }

    public function GenerateFields($fields)
    {
      foreach ($fields as $field) {

      }
    }

    public function SingleRow($field){
        $row =
        "
          <div class=\"row\">
            __content__
          </div>
        ";

        return ; // replace __content__ with $field
    }
  }


 ?>
