<?php
/**
 * A form for creating a new user.
 * 
* @package LydiaCore
 */
class CFormUserRemove extends CForm {

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->AddElement(new CFormElementText('name', array('required'=>true)))
         ->AddElement(new CFormElementText('email', array('required'=>true)))
         ->AddElement(new CFormElementSubmit('Remove', array('callback'=>array($object, 'DoRemove'))));
         
    $this->SetValidation('name', array('not_empty'))
         ->SetValidation('email', array('not_empty'));
  }
  
}
