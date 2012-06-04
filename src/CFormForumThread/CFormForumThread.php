<?php
/**
 * Form for komments
 */
class CFormForumThread extends CForm {

  /**
   * Properties
   */
  private $object;

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->object = $object;

    $this->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')))
    	 ->AddElement(new CFormElementHidden('type', array('value'=>"komment")))
    	 ->AddElement(new CFormElementHidden('key', array('value'=>$object['id'])))
    	 ->AddElement(new CFormElementHidden('id', array('value'=>"komment")))
    	 ->AddElement(new CFormElementHidden('filter', array('value'=>"bbcode")))
    	 ->AddElement(new CFormElementText('title', array('value'=>"komment")))
         ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
  }
  
  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $forum) {
    $forum['id']  = $form['id']['value'];
    $forum['title']   = $form['title']['value'];
    $forum['key']     = $form['key']['value'];
    $forum['data']    = $form['data']['value'];
    $forum['type']    = $form['type']['value'];
    $forum['filter']  = $form['filter']['value'];
    return $forum->Save();
  }
}
