<?php
class MY_Form_validation extends CI_Form_validation
{
  function __construct($config = array())
  {
    parent::__construct($config);
  }

  function error_array()
  {
    if (count($this->_error_array) === 0)
      return FALSE;
    else
      return $this->_error_array;
  }

  function reset_values()
  {
    $this->_field_data = array();
    $this->_error_array = array();
    $this->_error_messages = array();
    $this->error_string = array();
  }
}