<?php
/**
 * A form to manage content.
 * 
* @package LydiaCore
 */
class CFormForumMain extends CForm {

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

    $this->AddElement(new CFormElementImg('smile', array('value'=>'../../site/themes/mytheme/icon_smile.gif', 'code'=>'xxx')))
    	 ->AddElement(new CFormElementButton('B', array('value'=>'[b][/b]')))
   	 ->AddElement(new CFormElementButton('I', array('value'=>'[i][/i]')))
   	 ->AddElement(new CFormElementButton('U', array('value'=>'[u][/u]')))
   	 ->AddElement(new CFormElementButton('URL', array('value'=>'[url][/url]')))
   	 ->AddElement(new CFormElementButton('IMG', array('value'=>'[img][/img]')))
   	 ->AddElement(new CFormElementButton('Red text', array('value'=>'[color][/color]')))
   	 ->AddElement(new CFormElementButton('YouTube', array('value'=>'[youtube][/youtube]')))
    	 ->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')))
    	 ->AddElement(new CFormElementHidden('type', array('value'=>"tråd")))
    	 ->AddElement(new CFormElementHidden('key', array('value'=>$object['id'])))
    	 ->AddElement(new CFormElementHidden('id', array('value'=>"")))
    	 ->AddElement(new CFormElementHidden('filter', array('value'=>"bbcode")))
    	 ->AddElement(new CFormElementHidden('title', array('value'=>"")))
    	 ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
  }
  

  
  
  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $content) {

    $content['id']      = $form['id']['value'];
    $content['title']   = $form['title']['value'];
    $content['key']     = $form['key']['value'];
    $content['data']    = $form['data']['value'];
    $content['type']    = $form['type']['value'];
    $content['filter']  = $form['filter']['value'];

    return $content->Save();
  }
  
  
}








