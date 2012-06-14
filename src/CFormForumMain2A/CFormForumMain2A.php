<?php
/**
 * A form to manage content.
 * 
* @package LydiaCore
 */
class CFormForumMain2A extends CForm {

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

    $this->AddElement(new CFormElementHidden('title', array('value'=>$object['title'],'required'=>true)))
    	 ->AddElement(new CFormElementButton('B', array('value'=>'[b][/b]','value2'=>'', 'title' =>'')))
   	 ->AddElement(new CFormElementButton('I', array('value'=>'[i][/i]','value2'=>'', 'title' =>'')))
   	 ->AddElement(new CFormElementButton('U', array('value'=>'[u][/u]','value2'=>'', 'title' =>'')))
   	 ->AddElement(new CFormElementButton('URL', array('value'=>'[url][/url]','value2'=>'', 'title' =>'')))
   	 ->AddElement(new CFormElementButton('IMG', array('value'=>'[img][/img]','value2'=>'', 'title' =>'')))
   	 ->AddElement(new CFormElementColor('color', array('value'=>'', 'class'=>'color')))
   	 ->AddElement(new CFormElementButton('Lägg till färg', array('value'=>'[color=','value2'=>'][/color]', 'title' =>'')))
   	 ->AddElement(new CFormElementButton('YouTube', array('value'=>'[youtube][/youtube]','value2'=>'','title' =>'kopiera adressen ex. www.youtube.com/embed/W-Q7RMpINVo')))
    	 ->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:', 'value' => $object['data'])))
    	 ->AddElement(new CFormElementHidden('type', array('value'=> $object['type'])))
    	 ->AddElement(new CFormElementHidden('key', array('value'=>$object['key'])))
    	 ->AddElement(new CFormElementHidden('id', array('value'=> $object['id'])))
    	 ->AddElement(new CFormElementHidden('filter', array('value'=>"bbcode")))
    	 ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
        
    	 
         
  }
  
  
  /**
   * Callback to save the form Forum to database.
   */
  public function DoSave($form, $forum) {

    $forum['id']        = $form['id']['value'];
    $forum['title']     = $form['title']['value'];
    $forum['key']       = $form['key']['value'];
    $forum['data']      = $form['data']['value'];
    $forum['type']      = $form['type']['value'];
    $forum['filter']    = $form['filter']['value'];
 
    return $forum->edit();
  }
  
  
}
