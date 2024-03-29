<?php
/**
 * A page controller to display a page, for example an about-page, displays content labelled as "page".
 * 
* @package LydiaCore
 */
class CCPage extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }


  /**
   * Display an empty page.
   */
  public function Index() {
    $content = new CMContent();
    $this->views->SetTitle('Page');
    $this->session->storePage('../page');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'page', 'order-by'=>'id', 'order-order'=>'DESC')),
                  'usercheck' => $this->session->GetAuthenticatedUser(),
                ),'leftbar');
   }

  
  
  /**
   * Display a page.
   *
   * @param $id integer the id of the page.
   */
  public function View($id=null) {
  	  
    $content = new CMContent($id);
    if($content['type']=="komment")
    {
    	    $this->AddMessage('notice', 'Sidan kan inte visas');
    	    $this->RedirectToController();
    		    
    }
    $form = new CFormPage($content);
    $this->session->storePage('../page/view/'. $id);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToController();
    } else if($status === true) {
      $this->RedirectToController('view/' . $id);
    }  

    $this->views->SetTitle('Page: '.htmlEnt($content['title']));
    $this->views->AddInclude(__DIR__ . '/view.tpl.php', array(
                  'contents' => $content,'usercheck' => $this->session->GetAuthenticatedUser(),
                  'entries'=>$content->ListAll(array('type'=>'komment', 'order-by'=>'type', 'order-order'=>'DESC')),'form'=>$form,
                ),'leftbar');
 }
  

} 


/**
 * Form for komments
 */
class CFormPage extends CForm {

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

    $this->AddElement(new CFormElementTextarea('data', array('id'=>"boooba", 'label'=>'kommentar:','value'=>"")))
    	 ->AddElement(new CFormElementHidden('type', array('value'=>"komment")))
    	 ->AddElement(new CFormElementHidden('key', array('value'=>$object['id'])))
    	 ->AddElement(new CFormElementHidden('id', array('value'=>"")))
    	 ->AddElement(new CFormElementHidden('filter', array('value'=>"bbcode")))
    	 ->AddElement(new CFormElementHidden('title', array('value'=>"komment")))
         ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
  }
  
  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $content) {
    $content['id']  = $form['id']['value'];
    $content['title']   = $form['title']['value'];
    $content['key']     = $form['key']['value'];
    $content['data']    = $form['data']['value'];
    $content['type']    = $form['type']['value'];
    $content['filter']  = $form['filter']['value'];
    return $content->Save();
  }
}
