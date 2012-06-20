<?php
/**
 * Form for categoies
 */
class CFormForumCat extends CForm {

  /**
   * Properties
   */
  private $forum;

  /**
   * Constructor
   */
  public function __construct($forum) {
    parent::__construct();
    $this->forum = $forum;
    $this->AddElement(new CFormElementHidden('id', array('value'=>$forum['id'])))
         ->AddElement(new CFormElementText('title', array('value'=>$forum['title'],'required'=>true)))
         ->AddElement(new CFormElementSelect('Gäster', array('value'=>$forum['type'])))
         ->AddElement(new CFormElementHidden('type', array('value'=>"kategori")))
         ->AddElement(new CFormElementHidden('filter', array('value'=>"plain")))
         ->AddElement(new CFormElementSubmit('spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($forum))));

         $this->SetValidation('title', array('not_empty'));
  }
  

  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $forum) {
     if($form['Gäster']['value'] == "on")
     {
  	  $forum['key']  = "gäster";
  	  $forum['category']  = "gäster";
     }
     else
     {
     	  $forum['key']  = "medlem";
     	  $forum['category']  = "medlem";
     }
    $forum['id']    = $form['id']['value'];
    $forum['title'] = $form['title']['value'];
    $forum['type']  = $form['type']['value'];
    $forum['filter'] = $form['filter']['value'];
    

    return $forum->Save();
  }
}
