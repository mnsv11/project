<?php
/**
 * A form to manage content.
 * 
* @package LydiaCore
 */
class CFormForumMain2 extends CForm {

  /**
   * Properties
   */
  private $forum;

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->object = $object;

    $this->AddElement(new CFormElementText('title', array('value'=>"",'required'=>true)))
    	 ->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')))
    	 ->AddElement(new CFormElementHidden('type', array('value'=>"tråd")))
    	 ->AddElement(new CFormElementHidden('key', array('value'=>$object['id'])))
    	 ->AddElement(new CFormElementHidden('id', array('value'=>"")))
    	 ->AddElement(new CFormElementHidden('filter', array('value'=>"bbcode")))
    	 ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
         
    	 $this->SetValidation('title', array('not_empty'));
         
  }
  
  
  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $content) {

    $content['id']        = $form['id']['value'];
    $content['title']     = $form['title']['value'];
    $content['key']       = $form['key']['value'];
    $content['data']      = $form['data']['value'];
    $content['type']      = $form['type']['value'];
    $content['filter']    = $form['filter']['value'];

    return $content->Save();
  }
  
  
}
